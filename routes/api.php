<?php

use App\Http\Controllers\Api\LikePostController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('like-post/{post}', LikePostController::class)
    ->name('like-post')
    ->middleware('auth:sanctum');







