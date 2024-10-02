<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../model/Database.php';
require 'Helper.php';
require 'ResponseHelper.php';
require 'SessionValidator.php';
require 'DataValidator.php';
require 'LoginController.php';
require 'HomeController.php';
require 'UserController.php';
require 'PartnerController.php';
require 'SpecialtyController.php';
require 'CustomerController.php';

class RouteController
{
    private $routes;
    private $baseUri;
    private $baseUrl;

    public function __construct()
    {
        session_start();
        $this->routes = require __DIR__ . '/../config/web.php';
        $this->baseUri = $this->getBaseUri();
        $this->baseUrl = $this->getBaseUrl();
    }

    private function getBaseUri()
    {
        return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    }

    private function getBaseUrl()
    {
        $protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $this->baseUri . '/';
    }

    public function handleRequest()
    {
        $uri = $this->getRequestedUri();
        $uri = rtrim($uri, '/');
        foreach ($this->routes as $route => $controllerAction) {
            $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {
                array_shift($matches);
                return $this->dispatch($controllerAction, $matches);
            }
        }
        return $this->sendErrorResponse(404);
    }



    private function getRequestedUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $this->baseUri) === 0) {
            $uri = substr($uri, strlen($this->baseUri));
        }
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    private function dispatch($controllerAction, $params)
    {
        list($controller, $action) = explode('@', $controllerAction);

        if ($controller !== 'LoginController') {
            if (!SessionValidator::validate()) {
                header("Location: {$this->getBaseUrl()}login");
                exit;
            }
        }

        if (class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            define('BASE_URL', $this->baseUrl);
            $result = call_user_func_array([$controllerInstance, $action], $params);
            return $result !== false ? $result : $this->sendErrorResponse(404);
        }

        return $this->sendErrorResponse(404);
    }

    private function sendErrorResponse($statusCode = 404)
    {
        http_response_code($statusCode);
        $errorViewPath = "views/{$statusCode}.view.php";
        if (file_exists($errorViewPath)) {
            include $errorViewPath;
        } else {
            echo "{$statusCode} Error: The requested resource was not found.";
        }
    }
}
