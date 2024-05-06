<?php

namespace App\core;

use App\core\classes\Uri;

class Parameter
{
    private $uri;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load()
    {
        return $this->getParameter();
    }

    private function getParameter()
    {
        if (substr_count($this->uri, '/') > 2) {
            $parameter = array_values(array_filter(explode('/', $this->uri)));

            return (object)[
                'first' => filter_var($parameter[2]),
                'next' => filter_var($this->getNextParameter(2)),
            ];
        }

        return 'index';
    }

    private function getNextParameter($actual)
    {
        $parameter = array_values(array_filter(explode('/', $this->uri)));

        return isset($parameter[$actual + 1]) ? $parameter[$actual + 1] : $parameter[$actual];
    }
}