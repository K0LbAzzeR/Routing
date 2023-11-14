<?php

declare(strict_types=1);

namespace App\RMVC;

use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;

class App
{
    /**
     * Run app
     *
     * @return void
     */
    public static function run(): void
    {
        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $methodName = 'getRoutes' . $requestMethod;

        foreach (Route::$methodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }
    }
}
