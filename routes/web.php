<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RakController;
use App\Mail\VerifikasiBuku;

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
// Route::get('/mail',function(){
//     return new VerifikasiBuku();
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');
Route::middleware(['auth','checkRole','verified'])->prefix('dashboard')->group(function(){
    Route::put('role/{id}', [PetugasController::class, 'role'])->name('role.petugas');
    Route::resource('user',UserController::class)->only(['update','destroy']);
    Route::resource('buku',BukuController::class);
    Route::resource('rak',RakController::class);
    Route::resource('member',MemberController::class)->only(['index']);
    Route::resource('petugas',PetugasController::class);
    Route::put('transaksi/verifikasi/{id}/{hari}', [TransaksiController::class, 'verifikasi'])->name('transaksi.verifikasi');
});

Route::middleware(['auth','verified'])->prefix('dashboard')->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('user',[UserController::class,'index'])->middleware('adminOnly')->name('user.index');
    Route::resource('profile',ProfileController::class)->only(['index','store']);
    Route::get('pinjam/{slug}', [TransaksiController::class, 'pinjam'])->name('transaksi.pinjam')->middleware('MemberOnly');
    Route::put('transaksi/kembali/{id}', [TransaksiController::class, 'kembali'])->name('transaksi.kembali');
    Route::resource('transaksi',TransaksiController::class);
});

require __DIR__.'/auth.php';
