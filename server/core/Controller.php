<?php

namespace App\core;

use App\core\classes\Uri;

class Controller
{
    private $uri;
    private $namespaceController;
    private $controller;
    private $namespaceService;
    private $service;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load()
    {
        $controller = $this->getController();

        if (!$this->controllerExist($controller)) {
            throw new \Exception('Controller does not exist');
        }

        return $this->instantiateController();
    }

    private function getController()
    {
        if ($this->uri == '/') {
            return 'DefaultController';
        }

        if (substr_count($this->uri, '-') >= 1) {
            $parts = explode('-', $this->uri);

            $this->uri = implode('', array_map('ucfirst', $parts));
        }

        if (substr_count($this->uri, '/') > 1) {
            [$controller] = array_values(array_filter(explode('/', $this->uri)));

            $name = ucfirst($controller);
            $this->serviceExist($name . 'Service');
            return $name . 'Controller';
        }

        $name = ucfirst(ltrim($this->uri, '/'));
        $this->serviceExist($name . 'Service');
        return $name. 'Controller';
    }

    private function controllerExist($controller)
    {
        $controllerExist = false;
        if (class_exists('App\controllers\\' . $controller)) {
            $controllerExist = true;
            $this->namespaceController = 'App\controllers';
            $this->controller = $controller;
        }

        return $controllerExist;
    }

    private function serviceExist($service)
    {
        $serviceExist = false;
        if (class_exists('App\services\\' . $service)) {
            $serviceExist = true;
            $this->namespaceService = 'App\services';
            $this->service = $service;
        }

        return $serviceExist;
    }

    private function instantiateController()
    {
        $controller = $this->namespaceController . '\\' . $this->controller;
        $service = $this->namespaceService . '\\' . $this->service;

        return new $controller(new $service());
    }
}