<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class RouteDispatcher
{
    private string $requestUri = '/';

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    public function setRequestUri(string $requestUri): void
    {
        $this->requestUri = $requestUri;
    }
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    private function saveRequestUri(): void
    {
        if ($_SERVER["REQUEST_URI"] !== '/') {
            $this->setRequestUri($this->removeSlashesFromString($_SERVER["REQUEST_URI"]));
            $route = $this->routeConfiguration->getRoute();
            $this->routeConfiguration->setRoute($this->removeSlashesFromString($route));
        }

        echo '<pre>';
        var_dump($this->requestUri);
        var_dump($this->routeConfiguration->getRoute());
        echo '</pre>';
    }

    /**
     * Removes the first and last slash from a string
     *
     * @param $string
     * @return array|string|null
     */
    private function removeSlashesFromString($string): array|string|null
    {
        return preg_replace('/(^\/)|(\/$)/', '', $string);
    }
    public function process(): void
    {
        $this->saveRequestUri();
    }
}