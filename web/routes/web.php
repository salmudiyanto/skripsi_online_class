<?php

use App\Http\Controllers\apiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'proseslogin']);
});


// untuk superadmin dan userlain
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/superadmin', [SuperAdminController::class, 'index']);
    Route::get('/datakelas', [SuperAdminController::class, 'datakelas'])->name('datakelas');
    Route::post('/simpankelas', [SuperAdminController::class, 'simpankelas'])->name('simpankelas');
    Route::post('/hapuskelas', [SuperAdminController::class, 'hapuskelas'])->name('hapuskelas');
    Route::post('/simpaneditekelas', [SuperAdminController::class, 'simpaneditkelas'])->name('simpaneditkelas');

    Route::get('/datasiswa', [SuperAdminController::class, 'datasiswa'])->name('datasiswa');
    Route::post('/simpansiswa', [SuperAdminController::class, 'simpansiswa'])->name('simpansiswa');
    Route::post('/hapussiswa', [SuperAdminController::class, 'hapussiswa'])->name('hapussiswa');
    Route::post('/simpaneditsiswa', [SuperAdminController::class, 'simpaneditsiswa'])->name('simpaneditsiswa');

    Route::get('/dataguru', [SuperAdminController::class, 'dataguru'])->name('dataguru');
    Route::post('/simpanguru', [SuperAdminController::class, 'simpanguru'])->name('simpanguru');
    Route::post('/hapusguru', [SuperAdminController::class, 'hapusguru'])->name('hapusguru');
    Route::post('/simpaneditguru', [SuperAdminController::class, 'simpaneditguru'])->name('simpaneditguru');

    Route::get('/datamapel', [SuperAdminController::class, 'datamapel'])->name('datamapel');
    Route::post('/simpanmapel', [SuperAdminController::class, 'simpanmapel'])->name('simpanmapel');
    Route::post('/hapusmapel', [SuperAdminController::class, 'hapusmapel'])->name('hapusmapel');
    Route::post('/simpaneditmapel', [SuperAdminController::class, 'simpaneditmapel'])->name('simpaneditmapel');

    Route::get('/datajadwal', [SuperAdminController::class, 'datajadwal'])->name('datajadwal');
    Route::post('/hapusjadwal', [SuperAdminController::class, 'hapusjadwal'])->name('hapusjadwal');
    Route::post('/simpaneditjadwal', [SuperAdminController::class, 'simpaneditjadwal'])->name('simpaneditjadwal');
    Route::post('/datajadwalkelas', [SuperAdminController::class, 'datajadwalkelas'])->name('datajadwalkelas');
    Route::get('/datajadwalkelas', [SuperAdminController::class, 'datajadwalkelas'])->name('datajadwalkelas');
    Route::post('/simpanjadwalkelas', [SuperAdminController::class, 'simpanjadwalkelas'])->name('simpanjadwalkelas');

    Route::get('/datajampelajaran', [SuperAdminController::class, 'datajampelajaran'])->name('datajampelajaran');
    Route::post('/simpanjampelajaran', [SuperAdminController::class, 'simpanjampelajaran'])->name('simpanjampelajaran');


});

// gru
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/guru', [GuruController::class, 'index']);
    Route::get('/materi', [GuruController::class, 'materi'])->name('materi');
    
    Route::post('/kelasmateri', [GuruController::class, 'kelasmateri'])->name('kelasmateri');
    Route::get('/kelasmateri', [GuruController::class, 'kelasmateri'])->name('kelasmateri');
    Route::post('/simpanmateri', [GuruController::class, 'simpanmateri'])->name('simpanmateri');
    Route::post('/simpaneditmateri', [GuruController::class, 'simpaneditmateri'])->name('simpaneditmateri');
    Route::post('/hapusmateri', [GuruController::class, 'hapusmateri'])->name('hapusmateri');
Route::post('/updatenilai', [GuruController::class, 'updatenilai'])->name('updatenilai');
Route::post('/editmateri', [GuruController::class, 'editmateri'])->name('editmateri');
    
    Route::get('/tugas', [GuruController::class, 'tugas'])->name('tugas');
    
    Route::post('/kelastugas', [GuruController::class, 'kelastugas'])->name('kelastugas');
    Route::get('/kelastugas', [GuruController::class, 'kelastugas'])->name('kelastugas');
    Route::post('/hapustugas', [GuruController::class, 'hapustugas'])->name('hapustugas');
    Route::post('/hapuskuis', [GuruController::class, 'hapuskuis'])->name('hapuskuis');
    Route::post('/hapusujian', [GuruController::class, 'hapusujian'])->name('hapusujian');
    Route::get('/tugaskelas', [GuruController::class, 'tugaskelas'])->name('tugaskelas');
    Route::post('/filetugassiswa', [GuruController::class, 'filetugassiswa'])->name('filetugassiswa');
    Route::post('/tugasnilai', [GuruController::class, 'tugasnilai'])->name('tugasnilai');
    Route::post('/simpantugas', [GuruController::class, 'simpantugas'])->name('simpantugas');
    Route::post('/simpanedittugas', [GuruController::class, 'simpanedittugas'])->name('simpanedittugas');
    Route::post('/simpaneditkuis', [GuruController::class, 'simpaneditkuis'])->name('simpaneditkuis');
    
    Route::get('/kuis', [GuruController::class, 'kuis'])->name('kuis');
    Route::post('/kelaskuis', [GuruController::class, 'kelaskuis'])->name('kelaskuis');
    Route::get('/kelaskuis', [GuruController::class, 'kelaskuis'])->name('kelaskuis');
    Route::post('/kuisnilai', [GuruController::class, 'kuisnilai'])->name('kuisnilai');
    Route::post('/filekuissiswa', [GuruController::class, 'filekuissiswa'])->name('filekuissiswa');
    Route::get('/kuiskelas', [GuruController::class, 'kuiskelas'])->name('kuiskelas');
    Route::post('/simpankuis', [GuruController::class, 'simpankuis'])->name('simpankuis');

    Route::get('/ujian', [GuruController::class, 'ujian'])->name('ujian');
    Route::get('/banksoal', [GuruController::class, 'banksoal'])->name('banksoal');
    Route::get('/nilaiujiansiswa', [GuruController::class, 'nilaiujiansiswa'])->name('nilaiujiansiswa');
    Route::post('/simpansoal', [GuruController::class, 'simpansoal'])->name('simpansoal');
    Route::post('/simpansoale', [GuruController::class, 'simpansoale'])->name('simpansoale');
    Route::post('/hapussoal', [GuruController::class, 'hapussoal'])->name('hapussoal');
    Route::post('/hapussoale', [GuruController::class, 'hapussoale'])->name('hapussoale');
    Route::post('/simpaneditsoal', [GuruController::class, 'simpaneditsoal'])->name('simpaneditsoal');
    Route::post('/simpaneditsoale', [GuruController::class, 'simpaneditsoale'])->name('simpaneditsoale');
    Route::post('/kelasujian', [GuruController::class, 'kelasujian'])->name('kelasujian');
    Route::get('/kelasujian', [GuruController::class, 'kelasujian'])->name('kelasujian');
    Route::post('/ujiannilai', [GuruController::class, 'ujiannilai'])->name('ujiannilai');
    Route::get('/ujiankelas', [GuruController::class, 'ujiankelas'])->name('ujiankelas');
    Route::post('/tambahujian', [GuruController::class, 'tambahujian'])->name('tambahujian');
    Route::post('/simpanujian', [GuruController::class, 'simpanujian'])->name('simpanujian');
    Route::get('/simpanujian', [GuruController::class, 'simpanujian'])->name('simpanujian');
    Route::post('/mulaiujian', [GuruController::class, 'mulaiujian'])->name('mulaiujian');

    Route::post('/selesaikanujian', [GuruController::class, 'selesaikanujian'])->name('selesaikanujian');
    Route::post('/simpansoalessay', [GuruController::class, 'simpansoalessay'])->name('simpansoalessay');
    

});

Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    // Route::get('/siswa', [SiswaController::class, 'index']);

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswamateri', [SiswaController::class, 'materi'])->name('siswamateri');
    Route::get('/filemateridetail', [SiswaController::class, 'filemateridetail'])->name('filemateridetail');
    Route::get('/datamaterisiswa', [SiswaController::class, 'datamaterisiswa'])->name('datamaterisiswa');
    Route::get('/siswatugas', [SiswaController::class, 'tugas'])->name('siswatugas');
    Route::get('/siswahasiltugas', [SiswaController::class, 'hasiltugas'])->name('siswahasiltugas');
    Route::get('/siswakuis', [SiswaController::class, 'kuis'])->name('siswakuis');
    Route::get('/siswahasilkuis', [SiswaController::class, 'hasilkuis'])->name('siswahasilkuis');
    
    Route::get('/detailkuis', [SiswaController::class, 'detailkuis'])->name('detailkuis');
    Route::post('/kumpulkuis', [SiswaController::class, 'kumpulkuis'])->name('kumpulkuis');

    Route::get('/detailtugas', [SiswaController::class, 'detailtugas'])->name('detailtugas');
    Route::post('/kumpultugas', [SiswaController::class, 'kumpultugas'])->name('kumpultugas');
});


Route::get('/apijadwalsiswa/{id}', [apiController::class, 'jadwalkelas'])->name('apijadwalsiswa');
Route::get('/apimateri/{id}', [apiController::class, 'materi'])->name('apimateri');
Route::get('/apitugas/{id}', [apiController::class, 'tugas'])->name('apitugas');
Route::get('/tampilsoal/{id}', [apiController::class, 'tampilsoal'])->name('tampilsoal');
Route::get('/tampilsoalkuis/{id}', [apiController::class, 'tampilsoalkuis'])->name('tampilsoalkuis');
Route::get('/apilisttugas/{siswa}/{mapel}/{stat}', [apiController::class, 'tugaslist'])->name('apitugaslist');
Route::get('/apilistkuis/{siswa}/{mapel}/{stat}', [apiController::class, 'kuislist'])->name('apikuislist');
Route::get('/apilistujian/{siswa}/{mapel}/{stat}', [apiController::class, 'nilailistujian'])->name('nilailistujian');
Route::post('/apikumpultugas', [apiController::class, 'apikumpultugas'])->name('apikumupltugas');
Route::get('/apikuis/{id}', [apiController::class, 'kuis'])->name('apikuis');
Route::get('/apiujian/{id}', [apiController::class, 'ujianqr'])->name('apiujian');
Route::get('/apiidujian/{id}', [apiController::class, 'idujian'])->name('apiidujian');
Route::get('/apisoal/{id}', [apiController::class, 'soal'])->name('apisoal');
Route::get('/apisoalessay/{id}', [apiController::class, 'soalessay'])->name('apisoalessay');
Route::post('/submitujian', [apiController::class, 'submitujian'])->name('submitujian');
Route::get('/apimaterimapel/{id}/{siswa}', [apiController::class, 'materimapel'])->name('apimaterimapel');
Route::post('/apiloginsiswa', [apicontroller::class, 'loginsiswa']);
Route::get('/dashboard/{id}', [apicontroller::class, 'dashboard']);
Route::post('/apikirimtugastext', [apicontroller::class, 'kirimtugastext']);
Route::post('/apikirimtugasfile', [apicontroller::class, 'kirimtugasfile']);
Route::post('/apikirimkuistext', [apicontroller::class, 'kirimkuistext']);
Route::post('/apikirimkuisfile', [apicontroller::class, 'kirimkuisfile']);






    