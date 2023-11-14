<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        return 111;
    }

    public function show($post, $bla)
    {
//        echo __METHOD__;
//        echo '<hr><pre>';
//        var_dump($this->paramRequestMap);
//        echo '</pre><hr>';
        return $bla;
    }
}
