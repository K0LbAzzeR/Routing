<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class Route
{
    /**
     * Routes get
     *
     * @var array
     */
    private static array $routesGet = [];

    /**
     * Get routes array
     *
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /**
     * Get RouteConfiguration
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
}
