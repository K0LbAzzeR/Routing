<?php

declare(strict_types=1);

namespace App\RMVC\Route;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array $paramMap = [];

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process(): void
    {
        $this->saveRequestUri();
        $this->createParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    private function run(): void
    {
        if (preg_match("/$this->getRequestUri()/", $this->routeConfiguration->getRoute())) {
            $this->render();
        }
    }

    private function render(): void
    {
        $className = $this->routeConfiguration->getController();
        $action = $this->routeConfiguration->getAction();

        //(new $className)->$action();

        echo '<hr><pre>';
        var_dump((new $className)->$action());
        echo '</pre><hr>';

        die();
    }

    private function getRequestUri(): string
    {
        return $this->requestUri;
    }

    private function setRequestUri(string $requestUri): void
    {
        $this->requestUri = $requestUri;
    }

    private function getParamMap(): array
    {
        return $this->paramMap;
    }

    private function setParamMap(array $paramMap): void
    {
        $this->paramMap = $paramMap;
    }

    private function createParamMap(): void
    {
        $paramMap = [];
        $routeArray = explode('/', $this->routeConfiguration->getRoute());

        foreach ($routeArray as $paramKey => $param) {

            if (preg_match('/{.*}/', $param)) {
                $paramMap[$paramKey] = $this->removeCurlyBraceFromString($param);
            }
        }
        $this->setParamMap($paramMap);
    }

    private RouteConfiguration $routeConfiguration;

    private function saveRequestUri(): void
    {
        if ($_SERVER["REQUEST_URI"] !== '/') {
            $this->setRequestUri($this->removeSlashesFromString($_SERVER["REQUEST_URI"]));
            $route = $this->routeConfiguration->getRoute();
            $this->routeConfiguration->setRoute($this->removeSlashesFromString($route));
        }
    }

    /**
     * Removes the first and last slash from a string
     *
     * @param string $string
     * @return array|string|null
     */
    private function removeSlashesFromString(string $string): array|string|null
    {
        return preg_replace('/(^\/)|(\/$)/', '', $string);
    }

    /**
     * Removes the first and last curly brace from a string
     *
     * @param string $string
     * @return array|string|null
     */
    private function removeCurlyBraceFromString(string $string): array|string|null
    {
        return preg_replace('/(^{)|(}$)/', '', $string);
    }

    private function prepareRegex(string $regex): array|string
    {
        return str_replace('/', '\/', $regex);
    }

    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->getRequestUri());

        foreach ($this->getParamMap() as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $requestUriArray[$paramKey] = '{*.}';
        }

        $this->setRequestUri(implode('/', $requestUriArray));
        $this->setRequestUri($this->prepareRegex($this->getRequestUri()));
    }
}
