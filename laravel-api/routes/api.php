<?php

use App\Http\Controllers\CreatePostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('post')->middleware('auth:sanctum')->group(function(){
    Route::post('/', CreatePostController::class);
});