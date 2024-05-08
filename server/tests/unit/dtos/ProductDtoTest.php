<?php

namespace App\tests\unit\dtos;

use App\dtos\ProductDto;
use PHPUnit\Framework\TestCase;

class ProductDtoTest extends TestCase
{
    public function testFromModelWithAllValuesCorrect()
    {
        $product = [
            'name' => 'Test',
            'description' => 'Test description',
            'value' => 123.0,
            'product_type_id' => 1
        ];

        $dto = ProductDto::fromModel($product);

        $this->assertEquals('Test', $dto->name);
        $this->assertEquals('Test description', $dto->description);
        $this->assertEquals(123.0, $dto->value);
        $this->assertEquals(1, $dto->product_type_id);
        $this->assertInstanceOf(ProductDto::class, $dto);
    }

    public function testFromModelMissingOneValue()
    {
        $product = [
            'description' => 'Test description',
            'value' => 123.0,
            'product_type_id' => 1
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelMissingTwoValue()
    {
        $product = [
            'description' => 'Test description',
            'product_type_id' => 1
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelMissingThreeValue()
    {
        $product = [
            'description' => null,
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelWithNameIncorrect()
    {
        $product = [
            'name' => 12,
            'description' => 'Test description',
            'value' => 123.0,
            'product_type_id' => 1
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelWithDescriptionIncorrect()
    {
        $product = [
            'name' => 'Test',
            'description' => 12,
            'value' => 123.0,
            'product_type_id' => 1
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelWithValueIncorrect()
    {
        $product = [
            'name' => 'Test',
            'description' => 'Test description',
            'value' => 'One hundred',
            'product_type_id' => 1
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }

    public function testFromModelWithProductTypeIdIncorrect()
    {
        $product = [
            'name' => 'Test',
            'description' => 'Test description',
            'value' => 123.0,
            'product_type_id' => 'Product Type Test'
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductDto::fromModel($product);
    }
}