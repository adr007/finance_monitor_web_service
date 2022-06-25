<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\AssetsController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/please-login', function(){
    return "Please Login 😜";
})->name('login');

Route::post('/login', [UserAuthController::class, 'gasLogin']);
Route::post('/register', [UserAuthController::class, 'gasRegis']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'gasLogout']);

    Route::post('/user/get', [UserController::class, 'getUserLogin']);

    Route::post('/asset/get-list', [AssetsController::class, 'getAssetsList']);

    Route::prefix('/sub-asset')->group(function () {
        Route::post('/create', [AssetsController::class, 'createSubAsset']);
        Route::post('/update', [AssetsController::class, 'updateSubAsset']);
        Route::post('/delete', [AssetsController::class, 'deleteSubAsset']);
        Route::post('/get', [AssetsController::class, 'getSubAssetById']);
        Route::post('/get-by-user', [AssetsController::class, 'getAllSubAssetsByUser']);
        Route::post('/summary', [AssetsController::class, 'getUserSummary']);

        Route::post('/convert', [AssetsController::class, 'convertAsset']);
    });

    Route::prefix('/transaction')->group(function () {
        Route::post('/create', [TransactionController::class, 'createTransaction']);
        Route::post('/update', [TransactionController::class, 'updateTransaction']);
        Route::post('/delete', [TransactionController::class, 'deleteTransaction']);
        Route::post('/get', [TransactionController::class, 'getTransById']);
        Route::post('/get-by-user', [TransactionController::class, 'getAllTransByUser']);
    });

    Route::prefix('/tag')->group(function () {
        Route::post('/getAll', [TagController::class, 'getAllTag']);
    });
});