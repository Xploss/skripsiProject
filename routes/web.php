<?php

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

Route::get('/', function () {
    $halaman = '/';
    return view('index', compact('halaman'));
});

Route::get('/about', function () {
    $halaman = 'about';
    return view('about', compact('halaman'));
});


Auth::routes(['register' => 'false']);

Route::get('training/delete', 'TrainingController@delete');
Route::get('training/cari', 'TrainingController@cari');
Route::post('training/import_excel', 'TrainingController@import_excel');
Route::resource('training', 'TrainingController');

Route::post('dataset/import_excel', 'DatasetController@import_excel');
Route::resource('dataset', 'DatasetController');

Route::get('mahasiswa/export', 'MahasiswaController@export');
Route::get('mahasiswa/cari', 'MahasiswaController@cari');
Route::resource('mahasiswa', 'MahasiswaController');

Route::resource('prediksi', 'PrediksiController');

Route::get('verifikasi/cari', 'VerifikasiController@cari');
Route::resource('verifikasi', 'VerifikasiController');

Route::get('akun/cari', 'AkunController@cari');
Route::resource('akun', 'AkunController');

Route::resource('regis','RegisController');
