<?php

namespace App\tests\unit\core;

use App\core\Controller;
use PHPUnit\Framework\TestCase;
use App\controllers\SaleController;
use App\controllers\DefaultController;
use App\controllers\ProductTypeController;

class ControllerTest extends TestCase
{
    public function testLoadDefaultController(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $controller = new Controller();

        $result = $controller->load();

        $this->assertInstanceOf(DefaultController::class, $result);
    }

    public function testLoadSaleController(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale';
        $controller = new Controller();

        $result = $controller->load();

        $this->assertInstanceOf(SaleController::class, $result);
    }

    public function testLoadSaleControllerWithMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale/show/1';
        $controller = new Controller();

        $result = $controller->load();

        $this->assertInstanceOf(SaleController::class, $result);
    }

    public function testLoadProductTypeController(): void
    {
        $_SERVER['REQUEST_URI'] = '/product-type';
        $controller = new Controller();

        $result = $controller->load();

        $this->assertInstanceOf(ProductTypeController::class, $result);
    }

    public function testLoadProductTypeControllerWithMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/product-type/show/1';
        $controller = new Controller();

        $result = $controller->load();

        $this->assertInstanceOf(ProductTypeController::class, $result);
    }

    public function testLoadControllerWithNonExistentController(): void
    {
        $_SERVER['REQUEST_URI'] = '/purchase';
        $controller = new Controller();

        $this->expectException(\Exception::class);

        $result = $controller->load();

        $expected = new \Exception('Controller does not exist');
        $this->assertEquals($expected, $result);
    }
}