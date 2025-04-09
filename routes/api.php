<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/create', [FriendRequestController::class, 'create']);});
