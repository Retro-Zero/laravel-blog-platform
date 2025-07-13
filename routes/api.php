<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routes for posts
Route::get('/posts', [PostController::class, 'apiIndex']);
Route::get('/posts/{post}', [PostController::class, 'apiShow']);
Route::post('/posts', [PostController::class, 'apiStore']);
Route::put('/posts/{post}', [PostController::class, 'apiUpdate']);
Route::delete('/posts/{post}', [PostController::class, 'apiDestroy']);