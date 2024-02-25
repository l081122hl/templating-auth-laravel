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

    });

    route::get('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

});
