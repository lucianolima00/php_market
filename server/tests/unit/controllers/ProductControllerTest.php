<?php

namespace App\tests\unit\controllers;

use App\App;
use App\models\Product;
use App\dtos\ProductDto;
use App\models\ProductType;
use PHPUnit\Framework\TestCase;
use App\services\ProductService;
use App\controllers\ProductController;

class ProductControllerTest extends TestCase
{
    private static $connection;
    private static $productType;
    private static $product;
    private $mockService;

    public static function setUpBeforeClass(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $config = require 'config.php';

        (new App($config));

        self::$connection = App::connection();
        self::$connection->exec("TRUNCATE TABLE product");

        $productType = new ProductType();
        self::$productType = [
            'name' => 'Test Product Type',
            'tax' => 10.0
        ];
        self::$productType = array_merge(['id' => (int)$productType->create(self::$productType)], self::$productType);

        $product = new Product();
        self::$product = [
            'name' => 'Product Test',
            'description' => '',
            'value' => 123.0,
            'product_type_id' => self::$productType['id'],
        ];
        self::$product = array_merge(['id' => (int)$product->create(self::$product)], self::$product);

    }

    protected function setUp(): void
    {
        $this->mockService = $this->getMockBuilder(ProductService::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testActionIndex()
    {
        $this->mockService->expects($this->once())
            ->method('all')
            ->willReturn([
                (object)self::$product,
            ]);

        $result = (new ProductController($this->mockService))->index();

        $this->assertEquals(json_encode([
            (object)self::$product,
        ]), $result);
    }

    public function testActionShow()
    {
        $this->mockService->expects($this->once())
            ->method('one')
            ->willReturn((object)self::$product);

        $result = (new ProductController($this->mockService))->show((object)['first' => self::$product['id'], 'next' => self::$product['id']]);

        $this->assertEquals(json_encode((object)self::$product), $result);
    }

    /*public function testActionStore()
    {
        $this->mockService->expects($this->once())
            ->method('store')
            ->with([
                ProductDto::fromModel(self::$product)
            ])
            ->willReturn(1);

        $result = (new ProductController($this->mockService))->store();

        $this->assertEquals(json_encode(1), $result);
    }*/
}