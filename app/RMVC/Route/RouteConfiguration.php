<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class RouteConfiguration
{
    /**
     * Route
     *
     * @var string
     */
    private string $route;

    /**
     * Controller
     *
     * @var string
     */
    private string $controller;

    /**
     * Action
     *
     * @var string
     */
    private string $action;

    /**
     * ->name()
     *
     * @var string
     */
    private string $name;

    /**
     * ->middleware()
     *
     * @var string
     */
    private string $middleware;

    /**
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $route, string $controller, string $action)
    {
        $this->setRoute($route);
        $this->setController($controller);
        $this->setAction($action);
    }

    /**
     * @param string $name
     * @return RouteConfiguration
     */
    public function name(string $name): RouteConfiguration
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $middleware
     * @return RouteConfiguration
     */
    public function middleware(string $middleware): RouteConfiguration
    {
        $this->middleware = $middleware;
        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return void
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * Get controller
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return void
     */
    private function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return void
     */
    private function setAction(string $action): void
    {
        $this->action = $action;
    }
}
