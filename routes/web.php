<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->prefix('dashboard')->group(function(){
    Route::resource('buku',BukuController::class);
    Route::resource('member',MemberController::class);
    Route::resource('petugas',PetugasController::class);
    Route::resource('transaksi',TransaksiController::class);
});

require __DIR__.'/auth.php';
