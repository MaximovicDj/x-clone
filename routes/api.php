<?php

use App\Http\Controllers\Api\LikePostController;
use App\Http\Controllers\Api\PostCommentsController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('like-post/{post}', LikePostController::class)
        ->name('like-post');

    Route::get('/post/comments/{post}', PostCommentsController::class)->name('post.comments');
});









