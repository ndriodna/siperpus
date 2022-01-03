<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RakController;

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
Route::get('/',[LandingController::class,'index'])->name('landing.index');
Route::get('/buku/{id}',[LandingController::class,'show'])->name('landing.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth','checkRole'])->prefix('dashboard')->group(function(){
    Route::put('role/{id}', [PetugasController::class, 'role'])->name('role.petugas');
    Route::resource('user',UserController::class);
    Route::resource('buku',BukuController::class);
    Route::resource('rak',RakController::class)->except(['create','update']);
    Route::resource('member',MemberController::class);
    Route::resource('petugas',PetugasController::class);
    Route::put('transaksi/verifikasi/{id}', [TransaksiController::class, 'verifikasi'])->name('transaksi.verifikasi');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function(){
    Route::resource('profile',ProfileController::class)->only(['index','store']);
    Route::get('pinjam/{slug}', [TransaksiController::class, 'pinjam'])->name('transaksi.pinjam');
    Route::put('transaksi/kembali/{id}', [TransaksiController::class, 'kembali'])->name('transaksi.kembali');
    Route::resource('transaksi',TransaksiController::class);
});

require __DIR__.'/auth.php';
