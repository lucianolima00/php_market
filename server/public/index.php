<?php

require "bootstrap.php";

try {
    $controller = new \App\core\Controller();
    $controller = $controller->load();

    $method = new \App\core\Method();
    $method = $method->load($controller);

    $parameter = new \App\core\Parameter();
    $parameter = $parameter->load();

    $controller->$method($parameter);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}