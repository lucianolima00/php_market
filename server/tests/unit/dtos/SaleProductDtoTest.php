<?php

namespace App\tests\unit\dtos;

use App\dtos\SaleProductDto;
use PHPUnit\Framework\TestCase;

class SaleProductDtoTest extends TestCase
{
    public function testFromModelWithAllValuesCorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 12.0,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $dto = SaleProductDto::fromModel($product);

        $this->assertEquals(1, $dto->product_id);
        $this->assertEquals(12.0, $dto->quantity);
        $this->assertEquals(10.0, $dto->unit_value);
        $this->assertEquals(12.0, $dto->tax);
        $this->assertEquals(1, $dto->sale_id);
        $this->assertEquals(12.0, $dto->total);
        $this->assertInstanceOf(SaleProductDto::class, $dto);
    }

    public function testFromModelMissingProductIdValue()
    {
        $product = [
            'quantity' => 12.0,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelMissingQuantityValue()
    {
        $product = [
            'product_id' => 1,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelMissingUnitValueFieldValue()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 12.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelMissingTaxValue()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 12.0,
            'unit_value' => 10.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithProductIdIncorrect()
    {
        $product = [
            'product_id' => 'Product Test',
            'quantity' => 12.0,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithQuantityIncorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 'Two',
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithUnitValueIncorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 2.0,
            'unit_value' => 'Ten dollars',
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithTaxIncorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 2.0,
            'unit_value' => 10.0,
            'tax' => 'Twelve',
            'sale_id' => 1,
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithSaleIdIncorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 2.0,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 'Test Sale',
            'total' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }

    public function testFromModelWithTotalIncorrect()
    {
        $product = [
            'product_id' => 1,
            'quantity' => 2.0,
            'unit_value' => 10.0,
            'tax' => 12.0,
            'sale_id' => 1,
            'total' => 'One hundred and twenty',
        ];

        $this->expectException(\InvalidArgumentException::class);

        SaleProductDto::fromModel($product);
    }
}