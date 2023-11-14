<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class Route
{
    /**
     * Routes GET
     *
     * @var array
     */
    private static array $routesGet = [];

    /**
     * Routes POST
     *
     * @var array
     */
    private static array $routesPost = [];

    /**
     * GET routes array
     *
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /**
     * POST routes array
     *
     * @return array
     */
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    /**
     * GET Route Configuration
     *
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
    public static function get(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;
        return $routeConfiguration;
    }

    /**
     * POST Route Configuration
     *
     * @param string $route
     * @param array $controller
     * @return RouteConfiguration
     */
    public static function post(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfiguration;
        return $routeConfiguration;
    }

    public static function redirect(string $url)
    {
        header('Location:' . $url);
    }
}
