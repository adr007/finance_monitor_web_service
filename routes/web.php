<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\web\PagesController;
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
    return "What we do in life, Echoes in Eternity 🌓🌔🌕🌖🌗";
});

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('web.login');
Route::post('/login/web', [UserAuthController::class, 'gasLogin'])->name('web.login.gas');
Route::post('/logout/web', [UserAuthController::class, 'gasLogout'])->name('web.login.logout');

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/transaction', [PagesController::class, 'transaction'])->name('user.transaction');
    });
});
