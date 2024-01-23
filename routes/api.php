<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 商品
Route::prefix('items')->group(function () {
    // 全商品情報取得
    Route::get('/', [ItemController::class, 'index']);
    // 商品新規登録
    Route::post('/store', [ItemController::class, 'storeItem']);
    // 商品詳細情報取得
    Route::get('/item/{id}', [ItemController::class, 'getItem']);
    // 商品詳細情報更新
    Route::patch('/item/{id}/update', [ItemController::class, 'updateItem']);
    // 商品削除
    Route::delete('/item/{id}/destroy', [ItemController::class, 'destroyItem']);
});
