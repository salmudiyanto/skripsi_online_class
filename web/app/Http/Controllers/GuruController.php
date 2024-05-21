<?php

namespace App\Http\Controllers;

use App\Models\jadwal_kelas;
use App\Models\jadwal_ujian;
use App\Models\jawaban_essay;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Soal;
use App\Models\soal_essay;
use App\Models\Tugas;
use App\Models\Ujian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GuruController extends Controller
{
    public function index(){
        $datakelas = jadwal_kelas::where('users.id', Auth::user()->id)->select('mapels.id as idmapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser')->leftJoin('mapels', function($join){$join->on('mapels.id', '=', 'jadwal_kelas.mapel');
        })->leftJoin('gurus', function($join){$join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();
        $datamapel = Mapel::where('users.id', Auth::user()->id)->select('mapels.id as idmapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser')->leftJoin('gurus', function($join){$join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();
        $datamateri = Materi::where('users.id', Auth::user()->id)->select('mapels.id as idmapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser')->leftJoin('mapels', function($join){$join->on('mapels.id', '=', 'materis.mapel');
        })->leftJoin('gurus', function($join){$join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();
        return view('home._homeguru', ['kelas' => count($datakelas), 'mapel' => count($datamapel), 'materi' => count($datamateri), ]);
    }

    public function materi(){
        $datamapel = Mapel::where('users.id', Auth::user()->id)->
        select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->
        leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })
        ->get();
        return view('materi._datamapel', ['datamapel' => $datamapel]);
    }

    public function kelasmateri(Request $req){
        $datamapel = Materi::where('users.id', Auth::user()->id)->where('mapels.id', $req->id)->select('materis.id as idmateri', 'materis.judul as judul', 'materis.mapel as mapel', 'materis.urut as urut', 'materis.tingkat as tingkat', 'materis.tahunajaran as tahunajaran', 'materis.deskripsi as deskripsi', 'materis.file as file', 'mapels.id as id', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel','gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru'
        )->leftJoin('mapels', function($join){
            $join->on('materis.mapel', '=', 'mapels.id');
        })->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();

        $detailmapel = Mapel::where('id', $req->id)->first();
        return view('materi._data', ['datamapel' => $datamapel, 'pelajaran' => $detailmapel->nama_mapel, 'keymapel' => $detailmapel->id]);
    }

    public function simpaneditmateri(Request $req){
        if($req->file('filemateri') !== null){
            $file = $req->file('filemateri');
            $target = 'filemateri';
            $nama = date('dmYHis').'.'.$file->getClientOriginalExtension();
            $file->move($target, $nama);

            Materi::where('id', $req->idmateri)->update([
                'judul' => $req->judul_materi,
                'tingkat' => $req->tingkat,
                'deskripsi' => $req->deskripsi,
                'tahunajaran' => $req->tahun_ajaran,
                'file' => $nama
            ]);
        }else{
            Materi::where('id', $req->idmateri)->update([
                'judul' => $req->judul_materi,
                'tingkat' => $req->tingkat,
                'tahunajaran' => $req->tahun_ajaran,
                'deskripsi' => $req->deskripsi,
            ]);
        }
        return redirect('materi');
    }


    public function simpanmateri(Request $req){
        $req->validate([
            'judul_materi' => ['required'],
            'tingkat' => ['required'],
            'tahun_ajaran' => ['required', 'digits:4'],
            'deskripsi' => ['required'],
            'filemateri' => ['required', 'mimes:pdf'],
        ]);
        DB::beginTransaction();
        $file = $req->file('filemateri');
        $target = 'filemateri';
        $nama = date('dmYHis').'.'.$file->getClientOriginalExtension();

        try{
            $file->move($target, $nama);
            $last = Materi::where('mapel', $req->idmapel)->where('tingkat', $req->tingkat)->where('tahunajaran', $req->tahun_ajaran)->get();
            $urut=count($last)+1;
            $materi = new Materi();
            $materi->judul = $req->judul_materi;
            $materi->mapel = $req->idmapel;
            $materi->urut = $urut;
            $materi->tingkat = $req->tingkat;
            $materi->tahunajaran = $req->tahun_ajaran;
            $materi->deskripsi = $req->deskripsi;
            $materi->file = $nama;
            $materi->save();
            DB::commit();
            return redirect()->route('kelasmateri', ['id' => $req->idmapel]);
        }catch(\Exception $e){
            return redirect()->back();
        }        
    }
    
     public function hapusmateri(Request $req){
        $hapus = Materi::where('id', $req->id)->delete();
        return redirect()->route('materi');
    }

    public function tugas(){
        $datamapel = Mapel::where('users.id', Auth::user()->id)->
        select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->
        leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })
        ->get();
        return view('tugas._datatugas', ['datamapel' => $datamapel]);
    }

    public function kelastugas(Request $req){
        $datamapel = jadwal_kelas::where('jadwal_kelas.mapel', $req->id)->select('jadwal_kelas.*', 'mapels.id as idmapel', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel','gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru', 'kelas.namakelas as namakelas', 'kelas.id as idkelas'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();

        $detailmapel = Mapel::where('id', $req->id)->first();
        return view('tugas._data', ['datamapel' => $datamapel, 'pelajaran' => $detailmapel->nama_mapel]);
        // dd($datamapel);
    }

    public function hapustugas(Request $req){
        Tugas::where('urut', $req->idurut)->where('mapel', $req->idmapel)->delete();
        return redirect('tugas');
    }

    public function hapuskuis(Request $req){
        Kuis::where('urut', $req->idurut)->where('mapel', $req->idmapel)->delete();
        return redirect('kuis');
    }


    public function hapusujian(Request $req){
        jadwal_ujian::where('id', $req->idujian)->delete();
        Soal::where('kelompoksoal', $req->idujian)->delete();
        soal_essay::where('kelompok_soal', $req->idujian)->delete();
        return redirect('ujian');
    }

    public function kuiskelas(Request $req){
        $datakuis = Kuis::where('siswas.kelas', $req->idkelas)->where('kuis.mapel', $req->idmapel)->select('kuis.*', 'siswas.id as siswaid', 'users.name as namasiswa'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('kuis.mapel', '=', 'mapels.id');
        })->get();
        
        $listkuis = Kuis::where('siswas.kelas', $req->idkelas)->where('kuis.mapel', $req->idmapel)->select('kuis.mapel', 'kuis.urut', 'kuis.deskripsi', 'kuis.mulai', 'kuis.selesai')->distinct('kuis.mapel', 'kuis.urut', 'kuis.soal', 'kuis.mulai', 'kuis.selesai')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('kuis.mapel', '=', 'mapels.id');
        })->get();
    
        $detailmapel = Mapel::where('id', $req->idmapel)->first();
        return view('kuis._datakuiskelas', ['datakuis' => $datakuis, 'pelajaran' => $detailmapel->nama_mapel, 'kelas' => $req->idkelas, 'mapel' => $req->idmapel,'listkuis' => $listkuis]);
    
        // $detailmapel = Mapel::where('id', $req->idmapel)->first();
        // return view('kuis._datakuiskelas', ['datakuis' => $datakuis, 'pelajaran' => $detailmapel->nama_mapel, 'kelas' => $req->idkelas, 'mapel' => $req->idmapel]);
        // dd($datamapel);
    }


    public function tugaskelas(Request $req){
        $datatugas = Tugas::where('siswas.kelas', $req->idkelas)->where('tugas.mapel', $req->idmapel)->select('tugas.*', 'siswas.id as siswaid', 'users.name as namasiswa'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('tugas.mapel', '=', 'mapels.id');
        })->get();
        
        $listtugas = Tugas::where('siswas.kelas', $req->idkelas)->where('tugas.mapel', $req->idmapel)->select('tugas.mapel', 'tugas.urut', 'tugas.deskripsi', 'tugas.mulai', 'tugas.selesai')->distinct('tugas.mapel', 'tugas.urut', 'tugas.soal', 'tugas.mulai', 'tugas.selesai')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('tugas.mapel', '=', 'mapels.id');
        })->get();

        $detailmapel = Mapel::where('id', $req->idmapel)->first();
        return view('tugas._datatugaskelas', ['datatugas' => $datatugas, 'pelajaran' => $detailmapel->nama_mapel, 'kelas' => $req->idkelas, 'mapel' => $req->idmapel,'listtugas' => $listtugas]);
        // dd($datamapel);
    }

    public function filetugassiswa(Request $req){
        $datatugas = Tugas::where('tugas.id', $req->id)->where('tugas.siswa', $req->siswa)->where('tugas.urut', $req->urut)->select('tugas.*', 'siswas.id as siswaid', 'users.name as namasiswa'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('tugas.mapel', '=', 'mapels.id');
        })->first();

        $detailmapel = Mapel::where('id', $req->idmapel)->first();
        return view('tugas._filetugas', ['datatugas' => $datatugas, 'pelajaran' => $detailmapel->nama_mapel, 'kelas' => $req->idkelas, 'mapel' => $req->idmapel]);
        // dd($datatugas);
    }

    public function filekuissiswa(Request $req){
        $datakuis = Kuis::where('kuis.id', $req->id)->where('kuis.siswa', $req->siswa)->where('kuis.urut', $req->urut)->select('kuis.*', 'siswas.id as siswaid', 'users.name as namasiswa'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('kuis.mapel', '=', 'mapels.id');
        })->first();

        $detailmapel = Mapel::where('id', $req->idmapel)->first();
        return view('kuis._filekuis', ['datakuis' => $datakuis, 'pelajaran' => $detailmapel->nama_mapel, 'kelas' => $req->idkelas, 'mapel' => $req->idmapel]);
        // dd($datakuis);
    }

    public function simpanedittugas(Request $req){
        Tugas::where('urut', $req->idurut)->where('mapel', $req->idmapel)->update([
            'deskripsi' => $req->soal,
            'mulai' => $req->mulai,
            'selesai' => $req->deadline
        ]);
        return redirect('tugas');
    }

    public function simpaneditkuis(Request $req){
        Kuis::where('urut', $req->idurut)->where('mapel', $req->idmapel)->update([
            'deskripsi' => $req->soal,
            'mulai' => $req->mulai,
            'selesai' => $req->deadline
        ]);
        return redirect('kuis');
    }

    public function simpantugas(Request $req){
        $req->validate([
            'soal' => ['required'],
            'mulai' => ['required'],
            'deadline' => ['required'],
            'kelas' => ['required'],
            'mapel' => ['required'],
        ]);
        $kelas = Siswa::where('kelas', $req->kelas)->get();
        DB::beginTransaction();
        try{
            foreach($kelas as $row){
                $urut = Tugas::where('siswa', $row->id)->where('mapel', $req->mapel)->get();
                $nomor = count($urut);
                $nomorbaru = $nomor+1;
                $tugas = new Tugas;
                $tugas->mapel = $req->mapel;
                $tugas->urut = $nomorbaru;
                $tugas->siswa = $row->id;
                $tugas->nilai = 0;
                $tugas->mulai = $req->mulai;
                $tugas->deskripsi = $req->soal;
                $tugas->selesai = $req->deadline;
                $tugas->stat = 'B';
                $tugas->jawab = '-';
                $tugas->file = '-';
                $tugas->save();
            }
            DB::commit();
            return redirect()->route('tugas');
        }catch(\Exception $e){
            // return redirect()->back();
            dd($e);
        }
    }

    public function kuis(){
        $datamapel = Mapel::where('users.id', Auth::user()->id)->
        select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->
        leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })
        ->get();
        return view('kuis._datakuis', ['datamapel' => $datamapel]);
    }

    public function kelaskuis(Request $req){
        $datamapel = jadwal_kelas::where('jadwal_kelas.mapel', $req->id)->select('jadwal_kelas.*', 'mapels.id as idmapel', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel','gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru', 'kelas.namakelas as namakelas', 'kelas.id as idkelas'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();

        $detailmapel = Mapel::where('id', $req->id)->first();
        return view('kuis._data', ['datamapel' => $datamapel, 'pelajaran' => $detailmapel->nama_mapel]);
        // dd($datamapel);
    }

    
    


   

    public function simpankuis(Request $req){
        $req->validate([
            'soal' => ['required'],
            'mulai' => ['required'],
            'deadline' => ['required'],
            'kelas' => ['required'],
            'mapel' => ['required'],
        ]);
        $kelas = Siswa::where('kelas', $req->kelas)->get();
        DB::beginTransaction();
        try{
            foreach($kelas as $row){
                $urut = Kuis::where('siswa', $row->id)->where('mapel', $req->mapel)->get();
                $nomor = count($urut);
                $nomorbaru = $nomor+1;
                $kuis = new Kuis;
                $kuis->mapel = $req->mapel;
                $kuis->urut = $nomorbaru;
                $kuis->siswa = $row->id;
                $kuis->nilai = 0;
                $kuis->mulai = $req->mulai;
                $kuis->deskripsi = $req->soal;
                $kuis->selesai = $req->deadline;
                $kuis->stat = 'B';
                $kuis->file = '-';
                $kuis->jawab = '-';
                $kuis->save();
            }
            DB::commit();
            return redirect()->route('kuis');
        }catch(\Exception $e){
            // return redirect()->back();
            dd($e);
        }
    }

    public function tugasnilai(Request $req){
        $req->validate([
            'nilai' => ['required', 'digits:2']
        ]);
        Tugas::where('id', $req->id)->update(['nilai' => $req->nilai]);
        return redirect()->route('tugas');
    }

    public function kuisnilai(Request $req){
        $req->validate([
            'nilai' => ['required', 'digits:2']
        ]);
        Kuis::where('id', $req->id)->update(['nilai' => $req->nilai]);
        return redirect()->route('kuis');
    }

    public function ujian(){
        $datamapel = Mapel::where('users.id', Auth::user()->id)->
        select('mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'mapels.guru as idgurumapel', 'gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru')->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->
        leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })
        ->get();
        return view('ujian._dataujian', ['datamapel' => $datamapel]);
    }

    public function kelasujian(Request $req){
        $datamapel = jadwal_kelas::where('jadwal_kelas.mapel', $req->id)->select('jadwal_kelas.*', 'mapels.id as idmapel', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel','gurus.id as idguru', 'gurus.id_user as iduserguru', 'users.id as iduser', 'users.name as namaguru', 'kelas.namakelas as namakelas', 'kelas.id as idkelas'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('gurus', function($join){
            $join->on('mapels.guru', '=', 'gurus.id');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'gurus.id_user');
        })->get();

        $detailmapel = Mapel::where('id', $req->id)->first();
        return view('ujian._data', ['datamapel' => $datamapel, 'pelajaran' => $detailmapel->nama_mapel]);
        // dd($datamapel);
    }


    public function ujiankelas(Request $req){
        // $dataujian = jadwal_ujian::leftJoin('mapels', function($join){
        //     $join->on('jadwal_ujians.mapel', '=', 'mapels.id');
        // })->leftJoin('soals', function($join){
        //     $join->on('soals.kelompoksoal', '=', 'jadwal_ujians.id');
        // })->leftJoin('soal_essays', function($join){
        //     $join->on('soal_essays.kelompok_soal', '=', 'jadwal_ujians.id');
        // })->select('jadwal_ujians.*', 'mapels.nama_mapel as namamapel', DB::raw('COUNT(soals.kelompoksoal) as jumlahPG'), DB::raw('COUNT(soal_essays.kelompok_soal) as jumlahessay'))->where('jadwal_ujians.mapel', $req->idmapel)->groupBy('jadwal_ujians.id')->get();
        $dataujian = DB::table('jadwal_ujians')->leftJoin('mapels', 'jadwal_ujians.mapel', '=', 'mapels.id')->leftJoin('soals', 'soals.kelompoksoal', '=', 'jadwal_ujians.id')->leftJoin('soal_essays', 'soal_essays.kelompok_soal', '=', 'jadwal_ujians.id')->select('jadwal_ujians.*', 'mapels.nama_mapel as namamapel', DB::raw('COUNT(DISTINCT soals.kelompoksoal, soals.urut) as jumlahPG'), DB::raw('COUNT(DISTINCT soal_essays.kelompok_soal, soal_essays.urut) as jumlahessay'))->where('jadwal_ujians.mapel', $req->idmapel)->groupBy('jadwal_ujians.id', 'jadwal_ujians.mapel', 'jadwal_ujians.kelas', 'jadwal_ujians.urut', 'jadwal_ujians.pilgan', 'jadwal_ujians.essay', 'jadwal_ujians.tanggal', 'jadwal_ujians.jam', 'jadwal_ujians.lama' , 'jadwal_ujians.stat', 'jadwal_ujians.qr', 'jadwal_ujians.created_at', 'jadwal_ujians.updated_at', 'mapels.nama_mapel')->get();
        return view('ujian._dataujiankelas', ['dataujian' => $dataujian, 'mapel' => $req->idmapel, 'kelas' => $req->idkelas]);
        // dd($datamapel);
    }


    public function selesaikanujian(Request $req){
        jadwal_ujian::where('id', $req->idUjian)->update(['stat' => 'S']);
        // $dataujian = jadwal_ujian::select('jadwal_ujians.*', 'mapels.nama_mapel as namamapel')->where('jadwal_ujians.mapel', $req->idmapel)->leftJoin('mapels', function($join){
        //     $join->on('jadwal_ujians.mapel', '=', 'mapels.id');
        // })->get();
        // return view('ujian._dataujiankelas', ['dataujian' => $dataujian, 'mapel' => $req->idmapel]);
        return redirect('ujian');
        // dd($datamapel);
    }

    public function banksoal(Request $req){
        $dataujian = Soal::where('kelompoksoal', $req->id)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->id)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->id]);
        // dd($datamapel);
    }

    public function updatenilai(Request $req){
        jawaban_essay::where('id_soal', $req->idSoal)->where('siswa', $req->idSiswa)->update([
            'nilai_jawaban' => $req->nilai
        ]);
        return Redirect::route('nilaiujiansiswa', ['id' => $req->idUjian]);
    }

    public function nilaiujiansiswa(Request $req){
        $dataujian = Ujian::select('ujians.id', 'ujians.siswa', 'ujians.id_soal','mapels.nama_mapel as namamapel', 'users.name as namasiswa', 'ujians.nilai as pilihangandanilai')->where('id_soal', $req->id)->leftJoin('users', function($join){
            $join->on('users.id', '=', 'ujians.siswa');
        })->leftJoin('mapels', function($join){
            $join->on('ujians.mapel', '=', 'mapels.id');
        })->get();

        $dataujian->map(function ($post, $index){
            $maxbobot = soal_essay::where('soal_essays.kelompok_soal', $post->id_soal)->sum('bobot');
            $jawabessaynilai = jawaban_essay::where('soal_essays.kelompok_soal', $post->id_soal)->where('jawaban_essays.siswa', $post->siswa)->leftJoin('soal_essays', function($join){
                $join->on('soal_essays.id', '=', 'jawaban_essays.id_soal');
            })->sum('nilai_jawaban');
            $jawabessay = jawaban_essay::where('soal_essays.kelompok_soal', $post->id_soal)->where('jawaban_essays.siswa', $post->siswa)->leftJoin('soal_essays', function($join){
                $join->on('soal_essays.id', '=', 'jawaban_essays.id_soal');
            })->get();
            $post->jawabessay = $jawabessay;
            $post->bobothitung = $maxbobot;
            $post->nilaiessay = $jawabessaynilai;
            return $post;
        });

        // dd($dataujian);


        
        return view('ujian._datanilai', ['datanilai' => $dataujian, 'idUjian'=>$req->id]);
        // dd($datamapel);
    }

    public function simpansoal(Request $req){
        
        $hitung = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        
        $nomor = count($hitung);
        $nomorbaru = $nomor+1;
        $soal = new Soal;
        $soal->kelompoksoal = $req->kelompoksoal;
        $soal->soal = $req->soal;
        $soal->a = $req->a;
        $soal->b = $req->b;
        $soal->c = $req->c;
        $soal->d = $req->d;
        $soal->jawaban_benar = $req->jawaban;
        $soal->urut = $nomorbaru;
        $soal->save();
        
        // $datasoal = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
        // dd($datamapel);
    }

    public function simpansoale(Request $req){
        
        $hitung = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        
        $nomor = count($hitung);
        $nomorbaru = $nomor+1;
        $soal = new soal_essay();
        $soal->kelompok_soal = $req->kelompoksoal;
        $soal->soal = $req->soal;
        $soal->bobot = $req->bobot;
        $soal->urut = $nomorbaru;
        $soal->save();
        
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
        // dd($datamapel);
    }

    public function tambahujian(Request $req){
        $mapel = Mapel::where('id', $req->mapel)->first();
        // dd($req);
        return view('ujian._tambahujian', ['mapel' => $req->mapel, 'namamapel' => $mapel->nama_mapel, 'kelas' => $req->idkelas]);
    }


    

    public function simpanujian(Request $req){
        $req->validate([
            'mapel' => ['required'],
            'tgl' => ['required'],
            'waktu' => ['required'],
            'lama' => ['required'],
        ]);
        DB::beginTransaction();
        try{
            $urut = jadwal_ujian::where('mapel', $req->mapel)->get();
            $nomor = count($urut);
            $nomorbaru = $nomor+1;
            $jadwalujian = new jadwal_ujian();
            $jadwalujian->mapel = $req->mapel;
            $jadwalujian->kelas = $req->idkelas;
            $jadwalujian->pilgan = '15';
            $jadwalujian->essay = '5';
            $jadwalujian->urut = $nomorbaru;
            $jadwalujian->tanggal = $req->tgl;
            $jadwalujian->jam = $req->waktu;
            $jadwalujian->stat = 'B';
            $jadwalujian->qr = sha1($req->mapel.$nomorbaru);
            $jadwalujian->lama = $req->lama;
            $jadwalujian->save();
            DB::commit();
            return redirect()->route('ujian');
        }catch(\Exception $e){
            dd($e);
        }        
    }

    public function hapussoal(Request $req){
        $hapus = Soal::where('id', $req->id)->delete();
        // $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
    }

    public function hapussoale(Request $req){
        $hapus = soal_essay::where('id', $req->id)->delete();
        // $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
    }
    
   

    public function simpaneditsoal(Request $req){
        $dataujian = Soal::where('id', $req->id)->update(
            [
                'soal' => $req->soal,
                'a' => $req->a,
                'b' => $req->b,
                'c' => $req->c,
                'd' => $req->d,
                'jawaban_benar' => $req->jawaban  
            ]
        );
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
    }


    public function simpaneditsoale(Request $req){
        $dataujian = soal_essay::where('id', $req->id)->update(
            [
                'soal' => $req->soal,
                'bobot' => $req->bobot  
            ]
        );
        $dataujian = Soal::where('kelompoksoal', $req->kelompoksoal)->get();
        $dataujiane = soal_essay::where('kelompok_soal', $req->kelompoksoal)->get();
        return view('ujian._datasoal', ['datasoal' => $dataujian, 'datasoale' => $dataujiane, 'kelompoksoal' => $req->kelompoksoal]);
    }

}
