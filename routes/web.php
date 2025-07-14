<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard posts routes - users can only manage their own posts
    Route::prefix('dashboard/posts')->name('dashboard.posts.')->group(function () {
        Route::get('/', [PostController::class, 'dashboardIndex'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('/{post}/toggle-publish', [PostController::class, 'togglePublish'])->name('toggle-publish');
    });
    // Dashboard comments routes
    Route::prefix('dashboard/comments')->name('dashboard.comments.')->group(function () {
        Route::get('/', [\App\Http\Controllers\CommentController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\CommentController::class, 'store'])->name('store');
        Route::get('/{comment}/edit', [\App\Http\Controllers\CommentController::class, 'edit'])->name('edit');
        Route::put('/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('update');
        Route::delete('/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('destroy');
    });
    // Post comments (store)
    Route::post('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'storeOnPost'])->name('posts.comments.store');
});

// Public posts route - anyone can view published posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
