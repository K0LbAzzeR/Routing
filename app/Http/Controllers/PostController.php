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
     * @param ...$arguments
     * @return string|false
     */
    public function show(...$arguments): string|false
    {
        //        echo __METHOD__, '<br>';
        //        echo '<hr><pre>';
        //        var_dump(...$arguments);
        //        echo '</pre><hr>';

        return View::view('post.show');
    }
}
