<?php

namespace App\Http\Controllers;

use App\Models\jadwal_kelas;
use App\Models\Kuis;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(){
        $datamapel = jadwal_kelas::where('users.id', Auth::user()->id)
        ->select('jadwal_kelas.*', 'mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'siswas.id_user as idusersiswa', 'users.id as iduser', 'users.name as siswa', 'kelas.namakelas as namakelas', 'kelas.id as idkelas'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('siswas', function($join){
            $join->on('kelas.id', '=', 'siswas.kelas');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'siswas.id_user');
        })->get();

        // $detailmapel = Mapel::where('id', $req->id)->first();
        return view('jadwal._siswadata', ['datamapel' => $datamapel]);
    }

    public function materi(){
        $datamapel = jadwal_kelas::where('users.id', Auth::user()->id)
        ->select('jadwal_kelas.*', 'mapels.id as idmapel', 'mapels.nama_mapel as namamapel', 'siswas.id_user as idusersiswa', 'users.id as iduser', 'users.name as siswa', 'kelas.namakelas as namakelas', 'kelas.id as idkelas'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
        })->leftJoin('kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('siswas', function($join){
            $join->on('kelas.id', '=', 'siswas.kelas');
        })->leftJoin('users', function($join){
            $join->on('users.id', '=', 'siswas.id_user');
        })->get();

        // $detailmapel = Mapel::where('id', $req->id)->first();
        return view('mapel._siswadata', ['datamapel' => $datamapel]);
    }

    public function datamaterisiswa(Request $req){
        $datamapel = Materi::where('mapels.id', $req->id)->select('materis.id as idmateri', 'materis.judul as judul', 'materis.mapel as mapel', 'materis.urut as urut', 'materis.tingkat as tingkat', 'materis.tahunajaran as tahunajaran', 'materis.deskripsi as deskripsi', 'materis.file as file', 'mapels.id as id', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel'
        )->leftJoin('mapels', function($join){
            $join->on('materis.mapel', '=', 'mapels.id');
        })->get();

        $detailmapel = Mapel::where('id', $req->id)->first();
        return view('materi._siswadata', ['datamapel' => $datamapel, 'pelajaran' => $detailmapel->nama_mapel, 'keymapel' => $detailmapel->id]);
    }


    public function filemateridetail(Request $req){
        $materi = Materi::where('id', $req->id)->first();
        return view('materi._filemateri', ['materi' => $materi]);
    }

    public function kuis(){
        $datakuis = Kuis::where('users.id', Auth::user()->id)->where('kuis.stat', 'B')->select('kuis.*', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->get();

        
        return view('kuis._siswadatakuis', ['datakuis' => $datakuis]);
        // dd($datamapel);
    }


    public function detailkuis(Request $req){
        $datakuis = Kuis::where('mapels.id', $req->idkuis)->select('kuis.*', 'mapels.*'
        )->leftJoin('mapels', function($join){
            $join->on('mapels.id', '=', 'kuis.mapel');
        })->first();

        return view('kuis._siswadetailkuis', ['datakuis' => $datakuis]);
        // dd($datakuis);
    }

    public function kumpulkuis(Request $req){
        $req->validate([
            'file_kuis' => ['required', 'mimes:pdf,png,jpg,jpeg']
        ]);
        $idkuis = $req->idkuis;
        $file = $req->file('file_kuis');
        $target = 'filekuis';
        $nama = date('dmYHis').'.'.$file->getClientOriginalExtension();
        DB::beginTransaction();

        try{
            $file->move($target, $nama);
            Kuis::where('id', $idkuis)->update(['stat' => 'S', 'file' => $nama]);
            DB::commit();
            return redirect()->route('siswakuis');
        }catch(\Exception $e){
            return redirect()->back();
        }   

    }

    public function tugas(){
        $datatugas = Tugas::where('users.id', Auth::user()->id)->where('tugas.stat', 'B')->select('tugas.*', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        )->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('kelas', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->leftJoin('jadwal_kelas', function($join){
            $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        })->leftJoin('mapels', function($join){
            $join->on('siswas.kelas', '=', 'kelas.id');
        })->get();

        
        return view('tugas._siswadatatugas', ['datatugas' => $datatugas]);
        // dd($datamapel);
    }

    public function detailtugas(Request $req){
        $datatugas = Tugas::where('mapels.id', $req->idtugas)->select('tugas.*', 'mapels.*'
        )->leftJoin('mapels', function($join){
            $join->on('mapels.id', '=', 'tugas.mapel');
        })->first();

        return view('tugas._siswadetailtugas', ['datatugas' => $datatugas]);
        // dd($datakuis);
    }

    public function kumpultugas(Request $req){
        $req->validate([
            'file_tugas' => ['required', 'mimes:pdf,png,jpg,jpeg']
        ]);
        $idtugas = $req->idtugas;
        $file = $req->file('file_tugas');
        $target = 'filetugas';
        $nama = date('dmYHis').'.'.$file->getClientOriginalExtension();
        DB::beginTransaction();

        try{
            $file->move($target, $nama);
            Tugas::where('id', $idtugas)->update(['stat' => 'S', 'file' => $nama]);
            DB::commit();
            return redirect()->route('siswatugas');
        }catch(\Exception $e){
            return redirect()->back();
        }   

    }

    
}
