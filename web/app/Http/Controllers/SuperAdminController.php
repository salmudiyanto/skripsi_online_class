<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\jadwal_kelas;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index(){
        $datakelas = Kelas::all();
        $dataguru = Guru::all();
        $datasiswa = Siswa::all();
        return view('home._homeadmin', ['kelas' => count($datakelas), 'siswa' => count($datasiswa), 'guru' => count($dataguru), ]);
    }


    public function datakelas(){
        $datakelas = Kelas::select('kelas.*', 'users.name as namagurus')->leftJoin('gurus', function($join){
            $join->on('gurus.id', '=', 'kelas.walikelas');
        })->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        $dataguru = Guru::where('gurus.wali', "Y")->select('gurus.id as idguru', 'users.name as namaguru')->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        return view('kelas._data', ['datakelas' => $datakelas, 'dataguru' => $dataguru]);
    }

    public function simpankelas(Request $req){
        $req->validate([
            'tahunajaran' => ['required'],
            'semester' => ['required'],
            'walikelas' => ['required'],
            'namapaket' => ['required'],
        ]);
        $kelas = new Kelas();
        $kelas->namakelas = $req->namakelas.$req->namapaket;
        $kelas->tahunajaran = $req->tahunajaran;
        $kelas->semester = $req->semester;
        $kelas->walikelas = $req->walikelas;
        if($kelas->save()){
            return redirect('datakelas');
        }else{
            return redirect()->back();
        }
    }

    public function simpaneditkelas(Request $req){
        $req->validate([
            'idKelas' => ['required'],
            'tahunajaran' => ['required'],
            'semester' => ['required'],
            'walikelas' => ['required'],
            'namapaket' => ['required'],
        ]);
        
        if(Kelas::where('id', $req->idKelas)->update([
            'namakelas' => $req->namakelas.$req->namapaket,
            'tahunajaran' => $req->tahunajaran,
            'semester' => $req->semester,
            'walikelas' => $req->walikelas,
        ])){
            return redirect('datakelas');
        }else{
            return redirect()->back();
        }
    }

    public function hapuskelas(Request $req){        
        if(Kelas::where('id', $req->idKelas)->delete()){
            return redirect('datakelas')->with('success', 'Data kelas berhasil di hapus');
        }else{
            return redirect()->back()->with('success', 'Data gagal di hapus');
        }
    }

    public function dataguru(){
        $dataguru = Guru::select('gurus.id as idguru', 'gurus.id_user as iduser', 'users.name as namaguru', 'gurus.nip as nip', 'gurus.jenis_kelamin as jeniskelamin', 'gurus.aktif_mengajar as aktif', 'gurus.wali as wali')->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        return view('guru._data', ['dataguru' => $dataguru]);
    }

    public function simpanguru(Request $req){
        $req->validate([
            'nama_guru' => ['required'],
            'username' => ['required', 'email'],
            'password' => ['required'],
            'nip' => ['required','digits:18'],
            'jenis_kelamin' => ['required'],
            'wali_kelas' => ['required'] 
        ]);
        DB::beginTransaction();

        try{
            $user = new User();
            $user->name = $req->nama_guru;
            $user->email = $req->username;
            $user->password = Hash::make($req->password);
            $user->role_id = '2';
            $user->save();

            $id_user = User::where('email', $req->username)->first();

            $guru = new Guru();
            $guru->id_user = $id_user->id;
            $guru->nip = $req->nip;
            $guru->jenis_kelamin = $req->jenis_kelamin;
            $guru->aktif_mengajar = "Y";
            $guru->wali = $req->wali_kelas;
            $guru->save();

            DB::commit();
            return redirect('dataguru');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back();
        }
    }

    public function hapusguru(Request $req){        
        if(Guru::where('id', $req->idGuru)->delete()){
            User::where('id', $req->idUser)->delete();
            return redirect('dataguru')->with('success', 'Data Guru berhasil di hapus');
        }else{
            return redirect()->back()->with('success', 'Data gagal di hapus');
        }
    }

    public function simpaneditguru(Request $req){
        $req->validate([
            'nama_guru' => ['required'],
            'nip' => ['required','digits:18'],
            'jenis_kelamin' => ['required'],
            'wali_kelas' => ['required'] 
        ]);
        DB::beginTransaction();

        try{

            User::where('id', $req->idUser)->update(['name' => $req->nama_guru]);

            Guru::where('id', $req->idGuru)->update([
                'nip' => $req->nip,
                'jenis_kelamin' => $req->jenis_kelamin,
                'wali' => $req->wali_kelas
            ]);
            

            DB::commit();
            return redirect('dataguru');
        }catch(\Exception $e){
           dd($e);
        }
    }

    public function datasiswa(){
        $datasiswa = Siswa::select('siswas.id as idsiswa', 'siswas.id_user as iduser', 'users.name as namasiswa', 'siswas.kelas as kelas', 'siswas.agama as agama', 'siswas.alamat as alamat','siswas.jenis_kelamin as jenis_kelamin', 'kelas.namakelas as namakelas')->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('kelas.id', '=', 'siswas.kelas');
        })->get();
        $datakelas = Kelas::where('tahunajaran', date('Y'))->get();
        return view('siswa._data', ['datasiswa' => $datasiswa, 'datakelas' => $datakelas]);
    }

    public function hapussiswa(Request $req){        
        if(Siswa::where('id', $req->idSiswa)->delete()){
            User::where('id', $req->idUser)->delete();
            return redirect('datasiswa')->with('success', 'Data Siswa berhasil di hapus');
        }else{
            return redirect()->back()->with('success', 'Data gagal di hapus');
        }
    }

    public function simpansiswa(Request $req){
        $req->validate([
        'nama_siswa' => ['required'],
        'username' => ['required'],
        'password' => ['required'],
        'kelas' => ['required'],
        'agama' => ['required'],
        'jenis_kelamin' => ['required'],
        'alamat' => ['required'],
        ]);

        DB::beginTransaction();

        try{
            $user = new User();
            $user->name = $req->nama_siswa;
            $user->email = $req->username;
            $user->password = Hash::make($req->password);
            $user->role_id = '3';
            $user->save();

            $id_user = User::where('email', $req->username)->first();

            $nis = Siswa::where('id', 'like', date('Y').'%')->orderBy('id', 'desc')->first();
            if(count(Siswa::where('id', 'like', date('Y').'%')->orderBy('id', 'desc')->get())>0){
                $kode = $nis->id;
                $urutan = (int)substr($kode, 6,3);
                $nomorbaru = $urutan+1;
            }else{
                $nomorbaru = 1;
            }
            $tahun = substr(date('Y'), 2,2);
            $kode=date('Y').sprintf("%03s", $nomorbaru);

            $siswa = new Siswa();
            $siswa->id = $kode;
            $siswa->id_user = $id_user->id;
            $siswa->kelas = $req->kelas;
            $siswa->jenis_kelamin = $req->jenis_kelamin;
            $siswa->agama = $req->agama;
            $siswa->alamat = $req->alamat;
            $siswa->save();

            DB::commit();
            return redirect('datasiswa');
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function simpaneditsiswa(Request $req){
        $req->validate([
        'idSiswa' => ['required'],
        'nama_siswa' => ['required'],
        'kelas' => ['required'],
        'agama' => ['required'],
        'jenis_kelamin' => ['required'],
        'alamat' => ['required'],
        ]);

        DB::beginTransaction();

        try{
            User::where('id', $req->idUser)->update(['name' => $req->nama_siswa]);

            Siswa::where('id', $req->idSiswa)->update([
                'kelas' => $req->kelas,
                'jenis_kelamin' => $req->jenis_kelamin,
                'agama' => $req->agama,
                'alamat' => $req->alamat
            ]);

            DB::commit();
            return redirect('datasiswa');
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function datamapel(){
        $datamapel = Mapel::select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();
        $dataguru = Guru::select('gurus.id as idguru', 'users.name as namaguru')->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        return view('mapel._data', ['datamapel' => $datamapel, 'dataguru' => $dataguru]);
    }

    public function simpanmapel(Request $req){
        $req->validate([
            'nama' => ['required'],
            'guru' => ['required'],
        ]);
        $mapel = new Mapel();
        $mapel->guru = $req->guru;
        $mapel->nama_mapel = $req->nama;
        
        if($mapel->save()){
            return redirect('datamapel');
        }else{
            return redirect()->back();
        }
    }

    public function simpaneditmapel(Request $req){
        $req->validate([
            'nama' => ['required'],
            'guru' => ['required'],
        ]);
        
        if(Mapel::where('id', $req->idMapel)->update([
            'guru' => $req->guru,
            'nama_mapel' => $req->nama,
        ])){
            return redirect('datamapel');
        }else{
            return redirect()->back();
        }
    }

    public function hapusmapel(Request $req){        
        if(Mapel::where('id', $req->idMapel)->delete()){
            return redirect('datamapel')->with('success', 'Data Mata Pelajaran berhasil di hapus');
        }else{
            return redirect()->back()->with('success', 'Data gagal di hapus');
        }
    }

    public function datajadwal(){
        $datakelas = Kelas::select('kelas.*', 'users.name as namagurus')->leftJoin('gurus', function($join){
            $join->on('gurus.id', '=', 'kelas.walikelas');
        })->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        $dataguru = Guru::where('gurus.wali', "Y")->select('gurus.id as idguru', 'users.name as namaguru')->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        return view('jadwal._datakelas', ['datakelas' => $datakelas, 'dataguru' => $dataguru]);
    }

    public function datajadwalkelas(Request $req){
        $datakelas = jadwal_kelas::where("jadwal_kelas.kelas", $req->idkelas)->select('jadwal_kelas.id as idjadwal', 'jadwal_kelas.hari as hari', 'jadwal_kelas.mapel as mapel', 'jadwal_kelas.jampelajaran as jampelajaran', 'jadwal_kelas.kelas as kelas', 'mapels.id as idmapel', 'mapels.guru as idmapelguru', 'mapels.nama_mapel as namamapel', 'gurus.id as idguru', 'users.name as namaguru', 'kelas.id as idkelas', 'kelas.namakelas as namakelas')->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('kelas.id', '=', 'jadwal_kelas.kelas');
        })->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('gurus.id_user', '=', 'users.id');
        })->get();
        // $dataguru = Guru::where('gurus.wali', "Y")->select('gurus.id as idguru', 'users.name as namaguru')->leftJoin('users', function($join){
            // $join->on('gurus.id_user', '=', 'users.id');
        // })->get();
        $datamapel = Mapel::select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();
        return view('jadwal._data', ['datakelas' => $datakelas, 'idkelas' => $req->idkelas, 'mapel' => $datamapel]);
    }

    public function simpaneditjadwal(Request $req){
        $req->validate([
            'hari' => ['required'],
            'jam' => ['required'],
            'mapel' => ['required']
        ]);
       
        
        
        if(jadwal_kelas::where('id', $req->idJadwal)->update([
            'hari' => $req->hari,
            'jampelajaran' => $req->jam,
            'mapel' => $req->mapel
           ])){
            return redirect('datajadwal');
        }else{
            return redirect()->back();
        }
    }

    public function hapusjadwal(Request $req){        
        if(jadwal_kelas::where('id', $req->idJadwal)->delete()){
            return redirect('datajadwal')->with('success', 'Data Mata Pelajaran berhasil di hapus');
        }else{
            return redirect()->back()->with('success', 'Data gagal di hapus');
        }
    }

    public function simpanjadwalkelas(Request $req){
        $req->validate([
            'idkelas' => ['required'],
            'hari' => ['required'],
            'jam' => ['required'],
            'mapel' => ['required']
        ]);
        $jk = new jadwal_kelas();
        $jk->hari = $req->hari;
        $jk->mapel = $req->mapel;
        $jk->kelas = $req->idkelas;
        $jk->jampelajaran = $req->jam;
        
        if($jk->save()){
            return redirect('datajadwal');
        }else{
            return redirect()->back();
        }
    }
}
