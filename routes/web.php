<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\TransController;
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
        Route::get('/report', [PagesController::class, 'report'])->name('user.report');
        Route::get('/asset', [PagesController::class, 'asset'])->name('user.asset');
        Route::get('/logs', [PagesController::class, 'logs'])->name('user.logs');

        Route::post('/asset/convert', [AssetController::class, 'convert'])->name('user.asset.convert');

        Route::post('/transaction/insert', [TransController::class, 'insert'])->name('user.transaction.insert');
        Route::delete('/transaction/delete', [TransController::class, 'delete'])->name('user.transaction.delete');
    });

    Route::prefix('/auth/asset')->group(function () {
        Route::get('/get/{id?}', [AssetController::class, 'get'])->name('auth.asset.get');
        Route::post('/insert', [AssetController::class, 'insert'])->name('auth.asset.insert');
        Route::post('/update', [AssetController::class, 'update'])->name('auth.asset.update');
        Route::delete('/delete', [AssetController::class, 'delete'])->name('auth.asset.delete');
    });

    Route::prefix('/data')->group(function () {
        Route::get('/transaction/user', [TransController::class, 'dataUser'])->name('data.transaction.user');
    });
});
