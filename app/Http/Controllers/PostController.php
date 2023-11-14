<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\RMVC\View\View;

class PostController extends Controller
{
    /**
     * Action index
     *
     * @return string|false
     */
    public function index(): string|false
    {
        return View::view('post.index');
    }

    /**
     * Action show
     *
     * @param string $post
     * @return string
     */
    public function show(string $post): string
    {
        return View::view('post.show', compact('post'));
    }
}
