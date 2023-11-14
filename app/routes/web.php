<?php

declare(strict_types=1);

use App\RMVC\Route\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('post.index')->middleware('auth');
Route::get('/posts/{post}/', [PostController::class, 'show'])->name('post.show')->middleware('auth');
Route::get('/posts/{post}/param/{param1}', [PostController::class, 'post.show'])->name('post.show')->middleware('auth');
Route::get('/posts/{post}/param/{param1}/param/{param2}', [PostController::class, 'post.show'])->name('post.show')->middleware('auth');
