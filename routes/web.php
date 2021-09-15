<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Routing\RouteGroup;

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
    return redirect()
        ->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/warga', [WargaController::class, 'index'])->name('warga');
});
Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('nilai');

Route::get('/warga/detail/{id_warga}', [WargaController::class, 'detail']);
Route::get('/penilaian/findNIK', [PenilaianController::class, 'findNIK'])->name('penilaian.findNIK');
Route::post('/penilaian/insert', [PenilaianController::class, 'insert']);
Route::post('/warga/insert', [WargaController::class, 'insert']);
Route::post('/petugas/insert', [PetugasController::class, 'insert']);

Route::post('/warga/update/{id_warga}', [WargaController::class, 'update']);
Route::post('/petugas/update/{id}', [PetugasController::class, 'update']);
Route::post('/penilaian/update/{id_nilai}', [PenilaianController::class, 'update']);

Route::get('/warga/delete/{id_warga}', [WargaController::class, 'delete']);
Route::get('/petugas/delete/{id}', [PetugasController::class, 'delete']);
Route::get('/penilaian/delete/{id_nilai}', [PenilaianController::class, 'delete']);

Route::get('/print', [RekomendasiController::class, 'print'])->name('print');
require __DIR__ . '/auth.php';

Route::middleware('admin')->group(function () {

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
});
