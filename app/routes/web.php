<?php

declare(strict_types=1);

use App\RMVC\Route\Route;

Route::get('/posts', [PostController::class, 'index'])->name('post.index')->middleware('auth');