<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

// posts routing
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
Route::get('/posts/{postId}', [PostController::class,'show'])->name('posts.show');
Route::get('/posts/{postId}/edit', [PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{postId}', [PostController::class,'update'])->name('posts.update');
Route::delete('/posts/{postId}', [PostController::class,'destroy'])->name('posts.destroy');

// post_likes routing
Route::post('/posts/{postId}/like', [PostLikeController::class,'like'])->name('posts.like');

// comments routing
Route::get('/posts/{postId}/comments/create', [CommentController::class,'create'])->name('comments.create');
Route::post('/posts/{postId}/comments', [CommentController::class,'store'])->name('comments.store');
Route::get('/posts/{postId}/comments/{commentId}/edit', [CommentController::class,'edit'])->name('comments.edit');
Route::put('/posts/{postId}/comments/{commentId}', [CommentController::class,'update'])->name('comments.update');
Route::delete('/posts/{postId}/comments/{commentId}', [CommentController::class,'destroy'])->name('comments.destroy');

// comment_likes routing
Route::post('/posts/{postId}/comments/{commentId}/like', [CommentLikeController::class,'like'])->name('comments.like');

// auth routing
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class,'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

Route::get('/profile/{user_id}', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('/profile/{user_id}/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/{user_id}', [ProfileController::class, 'updateProfile'])->name('profile.update');

