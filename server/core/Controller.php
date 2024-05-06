<?php

namespace App\core;

use App\core\classes\Uri;

class Controller
{
    private $uri;
    private $namespace;
    private $controller;

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

            return ucfirst($controller . 'Controller');
        }

        return ucfirst(ltrim($this->uri, '/')) . 'Controller';
    }

    private function controllerExist($controller)
    {
        $controllerExist = false;
        if (class_exists('App\controllers\\' . $controller)) {
            $controllerExist = true;
            $this->namespace = 'App\controllers';
            $this->controller = $controller;
        }

        return $controllerExist;
    }

    private function instantiateController()
    {
        $controller = $this->namespace . '\\' . $this->controller;

        return new $controller();
    }
}