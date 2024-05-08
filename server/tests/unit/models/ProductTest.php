<?php

namespace App\tests\unit\models;

use App\App;
use App\models\Product;
use App\models\ProductType;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private static $connection;
    private static $productType;
    private static $product;

    public function setUp(): void
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
            'value' => '123',
            'product_type_id' => self::$productType['id'],
        ];
        self::$product = array_merge(['id' => (int)$product->create(self::$product)], self::$product);
    }
    public function testAll()
    {
        $expected = [
            (object)self::$product,
        ];

        $result = (new Product())->all();

        $this->assertEquals($expected, $result);
    }

    public function testFindWithOneParams()
    {
        $expected = [
            (object)self::$product,
        ];

        $result = (new Product())->find(self::$product['id']);

        $this->assertEquals($expected, $result);
    }

    public function testFindWithParams()
    {
        $expected = [
            (object)self::$product,
        ];

        $result = (new Product())->find(['name' => 'Product Test']);

        $this->assertEquals($expected, $result);
    }

    public function testFindOneWithOneParams()
    {
        $expected = (object)self::$product;

        $result = (new Product())->findOne(self::$product['id']);

        $this->assertEquals($expected, $result);
    }

    public function testFindOneWithParams()
    {
        $expected = (object)self::$product;

        $result = (new Product())->findOne(['name' => 'Product Test']);

        $this->assertEquals($expected, $result);
    }

    public function testCreate()
    {
        $data = [
            'name' => 'Product Test',
            'description' => '',
            'value' => '123',
            'product_type_id' => self::$productType['id'],
        ];

        $result = (new Product())->create($data);

        $this->assertNotFalse($result);
    }

    public function testCreateWithNoData()
    {
        $data = [];

        $result = (new Product())->create($data);

        $this->assertFalse($result);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'Product Test',
            'description' => 'Description',
            'value' => '123',
            'product_type_id' => self::$productType['id'],
        ];

        $result = (new Product())->update(self::$product['id'], $data);

        $this->assertNotFalse($result);
    }

    public function testUpdateWithNoData()
    {
        $data = [];

        $result = (new Product())->update(self::$product['id'], $data);

        $this->assertFalse($result);
    }

    public function testDeleteWithId()
    {
        $result = (new Product())->delete(self::$product['id']);

        $this->assertNotFalse($result);
    }

    public function testDeleteWithParams()
    {
        $result = (new Product())->delete(['name' => self::$product['name']]);

        $this->assertNotFalse($result);
    }

    public function testDeleteWithWrongParams()
    {
        $result = (new Product())->delete('Wrong');

        $this->assertFalse($result);
    }

    public function tesDeleteWithNoParams()
    {
        $params = [];

        $result = (new Product())->delete($params);

        $this->assertFalse($result);
    }
}