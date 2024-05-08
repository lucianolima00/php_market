<?php

namespace App\tests\unit\core;

use App\core\Method;
use App\core\Controller;
use PHPUnit\Framework\TestCase;
use App\controllers\SaleController;
use App\controllers\DefaultController;
use App\controllers\ProductTypeController;

class MethodTest extends TestCase
{
    public function testLoadIndexMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $controller = new Controller();
        $controller = $controller->load();
        $method = new Method();

        $result = $method->load($controller);

        $expected = 'index';
        $this->assertEquals($expected, $result);
    }

    public function testLoadMethodWithNonExistentMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale/approve';
        $controller = new Controller();
        $controller = $controller->load();
        $method = new Method();

        $this->expectException(\Exception::class);

        $method->load($controller);
    }
}