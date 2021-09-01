<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', function () {
    return view('v_dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/warga', [WargaController::class, 'index'])->name('warga');
});
Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('nilai');
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');

Route::get('/warga/detail/{id_warga}', [WargaController::class, 'detail']);
Route::get('/penilaian/findNIK', [PenilaianController::class, 'findNIK'])->name('penilaian.findNIK');
Route::post('/penilaian/insert', [PenilaianController::class, 'insert']);
Route::post('/warga/insert', [WargaController::class, 'insert']);
Route::post('/petugas/insert', [PetugasController::class, 'insert']);

Route::post('/warga/update/{id_warga}', [WargaController::class, 'update']);
Route::post('/petugas/update/{id}', [PetugasController::class, 'update']);

Route::get('/warga/delete/{id_warga}', [WargaController::class, 'delete']);
Route::get('/petugas/delete/{id}', [PetugasController::class, 'delete']);

require __DIR__ . '/auth.php';
