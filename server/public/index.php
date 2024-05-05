<?php

use App\core\Method;
use App\core\Parameter;
use App\core\Controller;

require "bootstrap.php";

try {
    $controller = new Controller();
    $controller = $controller->load();

    $method = new Method();
    $method = $method->load($controller);

    $parameter = new Parameter();
    $parameter = $parameter->load();

    $controller->$method($parameter);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}