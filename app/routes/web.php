<?php

declare(strict_types=1);

use App\RMVC\Route\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post}/', [PostController::class, 'post.show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/param/{param1}', [PostController::class, 'post.show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/param/{param1}/param/{param2}', [PostController::class, 'post.show'])->name('posts.show')->middleware('auth');
