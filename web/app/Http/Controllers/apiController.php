<?php

namespace App\Http\Controllers;

use App\Models\jadwal_kelas;
use App\Models\jadwal_ujian;
use App\Models\jawaban_essay;
use App\Models\Kuis;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\soal_essay;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\DB;


class apiController extends Controller
{
    public function jadwalkelas($id){
        $datamapel = jadwal_kelas::where('users.id', $id)
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


        return response()->json($datamapel);
    }

    public function materi($id){
        $datamapel = jadwal_kelas::where('users.id', $id)
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

        return response()->json($datamapel);

    }

    public function kuis($id){
        $datakuis = Kuis::where('users.id', $id)->where('kuis.stat', 'B')->select('kuis.*', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
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

        
        return response()->json($datakuis);
    }

    public function kuislist($siswa, $mapel, $stat){
        $datatugas = Kuis::where('users.id', $siswa)->where('kuis.stat', $stat)->where('kuis.mapel', $mapel)->select('kuis.*', 'kuis.id as idKuis', 'siswas.*', 'users.name as namasiswa', 'mapels.*')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('mapels', function($join){
                $join->on('kuis.mapel', '=', 'mapels.id');
        })->get();


        //  $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', 'B')->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        // )->leftJoin('siswas', function($join){
        //     $join->on('siswas.id', '=', 'tugas.siswa');
        // })->leftJoin('users', function($join){
        //     $join->on('siswas.id_user', '=', 'users.id');
        // })->leftJoin('kelas', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->leftJoin('jadwal_kelas', function($join){
        //     $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        // })->leftJoin('mapels', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->get();
        
        return response()->json($datatugas);

    }

    
    public function tugaslist($siswa, $mapel, $stat){
        $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', $stat)->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('mapels', function($join){
                $join->on('tugas.mapel', '=', 'mapels.id');
        })->get();


        //  $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', 'B')->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        // )->leftJoin('siswas', function($join){
        //     $join->on('siswas.id', '=', 'tugas.siswa');
        // })->leftJoin('users', function($join){
        //     $join->on('siswas.id_user', '=', 'users.id');
        // })->leftJoin('kelas', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->leftJoin('jadwal_kelas', function($join){
        //     $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        // })->leftJoin('mapels', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->get();
        
        return response()->json($datatugas);

    }

    

    public function nilailist($siswa, $mapel, $stat){
        $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', $stat)->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'tugas.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('mapels', function($join){
                $join->on('tugas.mapel', '=', 'mapels.id');
        })->get();


        //  $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', 'B')->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        // )->leftJoin('siswas', function($join){
        //     $join->on('siswas.id', '=', 'tugas.siswa');
        // })->leftJoin('users', function($join){
        //     $join->on('siswas.id_user', '=', 'users.id');
        // })->leftJoin('kelas', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->leftJoin('jadwal_kelas', function($join){
        //     $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        // })->leftJoin('mapels', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->get();
        
        return response()->json($datatugas);

    }

    public function nilailistkuis($siswa, $mapel, $stat){
        $datatugas = Kuis::where('users.id', $siswa)->where('kuis.stat', $stat)->where('kuis.mapel', $mapel)->select('kuis.*', 'kuis.id as idKuis', 'siswas.*', 'users.name as namasiswa', 'mapels.*')->leftJoin('siswas', function($join){
            $join->on('siswas.id', '=', 'kuis.siswa');
        })->leftJoin('users', function($join){
            $join->on('siswas.id_user', '=', 'users.id');
        })->leftJoin('mapels', function($join){
                $join->on('kuis.mapel', '=', 'mapels.id');
        })->get();


        //  $datatugas = Tugas::where('users.id', $siswa)->where('tugas.stat', 'B')->where('tugas.mapel', $mapel)->select('tugas.*', 'tugas.id as idTugas', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
        // )->leftJoin('siswas', function($join){
        //     $join->on('siswas.id', '=', 'tugas.siswa');
        // })->leftJoin('users', function($join){
        //     $join->on('siswas.id_user', '=', 'users.id');
        // })->leftJoin('kelas', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->leftJoin('jadwal_kelas', function($join){
        //     $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
        // })->leftJoin('mapels', function($join){
        //     $join->on('siswas.kelas', '=', 'kelas.id');
        // })->get();
        
        return response()->json($datatugas);

    }

    public function nilailistujian($siswa, $mapel, $stat){
        // $datatugas = Ujian::where('users.id', $siswa)->where('kuis.stat', $stat)->where('kuis.mapel', $mapel)->select('kuis.*', 'kuis.id as idKuis', 'siswas.*', 'users.name as namasiswa', 'mapels.*')->leftJoin('siswas', function($join){
        //     $join->on('siswas.id', '=', 'kuis.siswa');
        // })->leftJoin('users', function($join){
        //     $join->on('siswas.id_user', '=', 'users.id');
        // })->leftJoin('mapels', function($join){
        //         $join->on('kuis.mapel', '=', 'mapels.id');
        // })->get();


        $dataujian = Ujian::select('ujians.id', 'ujians.siswa', 'ujians.id_soal','mapels.nama_mapel as namamapel', 'users.name as namasiswa', 'ujians.nilai as pilihangandanilai')->where('users.id', $siswa)->leftJoin('users', function($join){
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
            $post->nilaitot = (($jawabessaynilai/$maxbobot)*40)+$post->pilihangandanilai;

            return $post;
        });
        
        return response()->json($dataujian);

    }

    public function loginsiswa(Request $request){
        $email = $request->email;
        $password = $request->password;
        $cek = User::where('email', $email)->first();
        if($cek){
            if(Hash::check($password, $cek->password)){
                return response([
                    'status' => 'OK',
                    'message' => 'Berhasil Login',
                    'id_siswa' => $cek->id,
                    'nama_siswa' => $cek->name,
                ]);
            }else{
                return response([
                    'status' => 'NO',
                    'message' => 'Password Tidak Cocok'
                ]);
            }
        }else{
            return response([
                'status' => 'NO',
                'message' => 'Username Tidak di Temukan'
            ]);
        }

    }

    public function tugas($id){
        $datatugas = Tugas::where('users.id', $id)->where('tugas.stat', 'B')->select('tugas.*', 'siswas.*', 'users.name as namasiswa', 'mapels.*'
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
        return response()->json($datatugas);

    }
    
    public function tampilsoal($id){
        $datatugas = Tugas::where('id', $id)->first();
        return view('soal', ['soal' => $datatugas->deskripsi]);
    }

    public function tampilsoalkuis($id){
        $datatugas = Kuis::where('id', $id)->first();
        return view('soal', ['soal' => $datatugas->deskripsi]);
    }

    public function soal($id){
        $dataujian = jadwal_ujian::select('soals.*')->where('qr', $id)->
        leftJoin('soals', function($join){
            $join->on('soals.kelompoksoal', '=', 'jadwal_ujians.id');
        })->inRandomOrder()->limit(15)
        ->get();
        return response()->json($dataujian);

    }

    public function soalessay($id){
        $dataujian = jadwal_ujian::select('soal_essays.*')->where('qr', $id)->
        leftJoin('soal_essays', function($join){
            $join->on('soal_essays.kelompok_soal', '=', 'jadwal_ujians.id');
        })->inRandomOrder()->limit(15)
        ->get();
        return response()->json($dataujian);

    }

    public function kirimtugastext(Request $req){
        Tugas::where('id', $req->idTugas)->update([
            'stat' => 'B',
            'jawab' => $req->jawab
        ]);
        return response([
            'status' => 'Ok',
            'message' => 'Berhasil Simpan'
        ], 200);
    }

    public function kirimkuistext(Request $req){
        Kuis::where('id', $req->idKuis)->update([
            'stat' => 'B',
            'jawab' => $req->jawab
        ]);
        return response([
            'status' => 'Ok',
            'message' => 'Berhasil Simpan'
        ], 200);
    }

    public function kirimtugasfile(Request $req){
        $jenis = explode(".", $req->namafile);
        $tipe = $jenis[count($jenis)-1];
        $image = $req->file;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = rand(1000, 9999).'.'.$tipe;

        File::put(public_path('filetugas'). '/' . $imageName, base64_decode($image));
        Tugas::where('id', $req->idTugas)->update([
            'stat' => 'B',
            'file' => $imageName
        ]);
        return response([
            'status' => 'Ok',
            'message' => 'Berhasil Simpan'
        ], 200);
    }


    public function kirimkuisfile(Request $req){
        $jenis = explode(".", $req->namafile);
        $tipe = $jenis[count($jenis)-1];
        $image = $req->file;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = rand(1000, 9999).'.'.$tipe;

        File::put(public_path('filekuis'). '/' . $imageName, base64_decode($image));
        Kuis::where('id', $req->idKuis)->update([
            'stat' => 'B',
            'file' => $imageName
        ]);
        return response([
            'status' => 'Ok',
            'message' => 'Berhasil Simpan'
        ], 200);
    }


    public function submitujian(Request $req){
        $idUjian = $req->input('idUjian');
        $idSiswa = $req->input('idSiswa');
        $PG = json_decode($req->input('PG'));
        $Essay = json_decode($req->input('Essay'));

        $nilai = (array_sum($PG)/15)*60;
        $jawaban = array();

        $indexing = 0;

        foreach($Essay as $jawab){
            $jawaban[$indexing++] = $jawab;
        }

        
        DB::beginTransaction();

        try{
            $dataujian = jadwal_ujian::where('id', $idUjian)->first();
            $soalessay = soal_essay::where('kelompok_soal', $idUjian)->get();
            $ujian = new Ujian;
            $ujian->mapel = $dataujian->mapel;
            $ujian->urut = $dataujian->urut;
            $ujian->id_soal = $dataujian->id;
            $ujian->siswa = $idSiswa;
            $ujian->nilai = $nilai;
            $ujian->deskripsi = $dataujian->qr;
            $ujian->mulai = date('H:i:s');
            $ujian->selesai = date('H:i:s');
            $ujian->stat = 'S';
            $ujian->save();

            $indexinglagi = 0;

            foreach($soalessay as $essaynya){
                $jessay = new jawaban_essay();
                $jessay->id_soal = $essaynya->id;
                $jessay->siswa = $idSiswa;
                $jessay->jawaban = $jawaban[$indexinglagi++];
                $jessay->nilai_jawaban = 0;
                $jessay->save();
            }

            DB::commit();
            return response([
                'status' => 'Ok',
                'message' => 'Berhasil Simpan'
            ], 200);
            
        }catch(Exception $e){
            // DB::rollback();
            // return response([
            //     'status' => 'No',
            //     'message' => 'Gagal Submit Jawaban'
            // ], 200);
            dd($e);
        }

    }

    public function ujianqr($id){
        $datamapel = jadwal_ujian::where('qr', $id)
        ->select('jadwal_ujians.*', 'mapels.id as idmapel', 'mapels.nama_mapel as namamapel'
        )->leftJoin('mapels', function($join){
            $join->on('jadwal_ujians.mapel', '=', 'mapels.id');
        })->get();

        return response()->json($datamapel);

    }

    public function idujian($id){
        $datamapel = jadwal_ujian::where('qr', $id)->first();

        return response()->json($datamapel);

    }

    public function materimapel($id, $siswa){
        $caritingkat = User::where('users.id', $siswa)->select('kelas.namakelas as namakelas')->leftjoin('siswas', function($join){
            $join->on('users.id' ,'=', 'siswas.id_user');
        })->leftjoin('kelas', function($join){
            $join->on('kelas.id' ,'=', 'siswas.kelas' );
        })->first();
        $datamapel = Materi::where('mapels.id', $id)->where('materis.tingkat', substr($caritingkat->namakelas, 0,1))->select('materis.id as idmateri', 'materis.judul as judul', 'materis.mapel as mapel', 'materis.urut as urut', 'materis.tingkat as tingkat', 'materis.tahunajaran as tahunajaran', 'materis.deskripsi as deskripsi', 'materis.file as file', 'mapels.id as id', 'mapels.guru as guru', 'mapels.nama_mapel as nama_mapel'
        )->leftJoin('mapels', function($join){
            $join->on('materis.mapel', '=', 'mapels.id');
        })->get();

        return response()->json($datamapel);

    }

    
    public function dashboard($id){
        $datamateri = Materi::where('users.id', $id)->select('materis.judul')->leftJoin('mapels', function($join){
                $join->on('materis.mapel', '=', 'mapels.id');
            })->leftJoin('jadwal_kelas', function($join){
                $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
            })->leftJoin('kelas', function($join){
                $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
            })->leftJoin('siswas', function($join){
                $join->on('kelas.id', '=', 'siswas.kelas');
            })->leftJoin('users', function($join){
                $join->on('users.id', '=', 'siswas.id_user');
            })->distinct()->get();
            
        $datamapel = Mapel::where('users.id', $id)->select('mapels.nama_mapel')->leftJoin('jadwal_kelas', function($join){
                $join->on('jadwal_kelas.mapel', '=', 'mapels.id');
            })->leftJoin('kelas', function($join){
                $join->on('jadwal_kelas.kelas', '=', 'kelas.id');
            })->leftJoin('siswas', function($join){
                $join->on('kelas.id', '=', 'siswas.kelas');
            })->leftJoin('users', function($join){
                $join->on('users.id', '=', 'siswas.id_user');
            })->distinct()->get();
            
        $datatugas = Tugas::where('users.id', $id)->select('tugas.*')->leftJoin('siswas', function($join){
                $join->on('tugas.siswa', '=', 'siswas.id');
            })->leftJoin('users', function($join){
                $join->on('users.id', '=', 'siswas.id_user');
            })->get();
        $dataujian = Ujian::where('users.id', $id)->select('ujians.*')->leftJoin('siswas', function($join){
                $join->on('ujians.siswa', '=', 'siswas.id');
            })->leftJoin('users', function($join){
                $join->on('users.id', '=', 'siswas.id_user');
            })->get();
                    
        $datakuis = Kuis::where('users.id', $id)->select('kuis.*')->leftJoin('siswas', function($join){
                $join->on('kuis.siswa', '=', 'siswas.id');
            })->leftJoin('users', function($join){
                $join->on('users.id', '=', 'siswas.id_user');
            })->get();

        return response([
                'materi' => count($datamateri),
                'tugas' => count($datatugas),
                'kuis' => count($datakuis),
                'ujian' => count($dataujian),
        ]);
    }
}
