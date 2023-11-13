<?php

declare(strict_types=1);

use App\RMVC\Route\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('post.index')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show')->middleware('auth');
