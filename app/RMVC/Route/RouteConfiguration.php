<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class RouteConfiguration
{
    private string $route;
    private string $controller;
    private string $action;
    private string $name;
    private string $middleware;

    public function __construct(string $route, string $controller, string $action)
    {
        $this->setRoute($route);
        $this->setController($controller);
        $this->setAction($action);
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function name(string $name): RouteConfiguration
    {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): RouteConfiguration
    {
        $this->middleware = $middleware;
        return $this;
    }

}