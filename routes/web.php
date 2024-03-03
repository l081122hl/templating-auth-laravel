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
    return view('welcome');
});

route::get('/login',[App\Http\Controllers\AuthController::class, 'index'])->name('auth.index')->middleware('guest');
route::post('/login',[App\Http\Controllers\AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:user'], function (){
    Route::prefix('admin')->group(function (){
        Route::get('/',[App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile',[App\Http\Controllers\dashboardController::class, 'profile'])->name('dashboard.profile');

        Route::get('/kategori', [App\Http\Controllers\kategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [App\Http\Controllers\kategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah', [App\Http\Controllers\kategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');

        Route::get('/kategori/ubah/{id}', [App\Http\Controllers\kategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah', [App\Http\Controllers\kategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}', [App\Http\Controllers\kategoriController::class, 'hapus'])->name('kategori.hapus');
    });

    route::get('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

});
