<?php

declare(strict_types=1);

namespace App\RMVC\Route;

use JetBrains\PhpStorm\NoReturn;

class RouteDispatcher
{
    /**
     * Route configuration
     *
     * @var RouteConfiguration
     */
    private RouteConfiguration $routeConfiguration;

    /**
     * Request URI
     *
     * @var string
     */
    private string $requestUri = '/';

    /**
     * Param map
     *
     * @var array
     */
    private array $paramMap = [];

    /**
     * Param request map
     *
     * @var array
     */
    private array $paramRequestMap = [];

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    /**
     * Process:
     * saveRequestUri() ->
     * createParamMap() ->
     * makeRegexRequest() ->
     * run()
     *
     * @return void
     */
    public function process(): void
    {
        $this->saveRequestUri();
        $this->createParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    /**
     * Save request URI
     *
     * @return void
     */
    private function saveRequestUri(): void
    {
        if ($_SERVER["REQUEST_URI"] !== '/') {
            $this->setRequestUri($this->removeSlashesFromString($_SERVER["REQUEST_URI"]));
            $route = $this->routeConfiguration->getRoute();
            $this->routeConfiguration->setRoute($this->removeSlashesFromString($route));
        }
    }

    /**
     * Create param map
     *
     * @return void
     */
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

    /**
     * Make regex request
     *
     * @return void
     */
    private function makeRegexRequest(): void
    {
        $paramRequestMap = [];
        $requestUriArray = explode('/', $this->getRequestUri());

        foreach ($this->getParamMap() as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            // TODO: Get rid of direct access to the field
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->setRequestUri(implode('/', $requestUriArray));
        $this->setRequestUri($this->prepareRegex($this->getRequestUri()));
        //$this->setParamRequestMap();
    }

    /**
     * Run
     *
     * @return void
     */
    private function run(): void
    {
        $pattern = '/' . $this->getRequestUri() . '/';

        if (preg_match($pattern, $this->routeConfiguration->getRoute())) {
            $this->render();
        }
    }

    /**
     * Render
     *
     * @return void
     */
    #[NoReturn] private function render(): void
    {
        $className = $this->routeConfiguration->getController();
        $action = $this->routeConfiguration->getAction();

        // TODO: Get rid of direct access to the field
        echo (new $className())->$action(...$this->paramRequestMap);

        die();
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

    /**
     * Prepare regex
     *
     * @param string $regex
     * @return array|string
     */
    private function prepareRegex(string $regex): array|string
    {
        return str_replace('/', '\/', $regex);
    }

    /**
     * Get request URI
     *
     * @return string
     */
    private function getRequestUri(): string
    {
        return $this->requestUri;
    }

    /**
     * Set request URI
     *
     * @param string $requestUri
     * @return void
     */
    private function setRequestUri(string $requestUri): void
    {
        $this->requestUri = $requestUri;
    }

    /**
     * Get param map
     *
     * @return array
     */
    private function getParamMap(): array
    {
        return $this->paramMap;
    }

    /**
     * Set param map
     *
     * @param array $paramMap
     * @return void
     */
    private function setParamMap(array $paramMap): void
    {
        $this->paramMap = $paramMap;
    }

    /**
     * Get param request map
     *
     * @return array
     */
    private function getParamRequestMap(): array
    {
        return $this->paramRequestMap;
    }

    /**
     * Set param request map
     *
     * @param array $paramRequestMap
     * @return void
     */
    private function setParamRequestMap(array $paramRequestMap): void
    {
        $this->paramRequestMap = $paramRequestMap;
    }
}
