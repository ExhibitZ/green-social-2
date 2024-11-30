<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Route::resource('posts', PostController::class)->only(['index', 'create', 'show', 'store', 'edit', 'update', 'destroy']);

// posts routing
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
Route::get('/posts/{postId}', [PostController::class,'show'])->name('posts.show');
Route::get('/posts/{postId}/edit', [PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{postId}', [PostController::class,'update'])->name('posts.update');
Route::delete('/posts/{postId}', [PostController::class,'destroy'])->name('posts.destroy');

// comments routing
Route::get('/posts/{postId}/comments/create', [CommentController::class,'create'])->name('comments.create');
Route::post('/posts/{postId}/comments', [CommentController::class,'store'])->name('comments.store');