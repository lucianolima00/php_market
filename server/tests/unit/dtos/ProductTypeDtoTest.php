<?php

namespace App\tests\unit\dtos;

use App\dtos\ProductTypeDto;
use PHPUnit\Framework\TestCase;

class ProductTypeDtoTest extends TestCase
{
    public function testFromModelWithAllValuesCorrect()
    {
        $productType = [
            'name' => 'Test',
            'tax' => 12.0,
        ];

        $dto = ProductTypeDto::fromModel($productType);

        $this->assertEquals('Test', $dto->name);
        $this->assertEquals(12.0, $dto->tax);
        $this->assertInstanceOf(ProductTypeDto::class, $dto);
    }

    public function testFromModelMissingOneValue()
    {
        $productType = [
            'tax' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductTypeDto::fromModel($productType);
    }

    public function testFromModelMissingTwoValues()
    {
        $this->expectException(\InvalidArgumentException::class);

        ProductTypeDto::fromModel([]);
    }

    public function testFromModelWithNameIncorrect()
    {
        $productType = [
            'name' => 12,
            'tax' => 12.0,
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductTypeDto::fromModel($productType);
    }

    public function testFromModelWithTaxIncorrect()
    {
        $productType = [
            'name' => 'Test',
            'tax' => 'One hundred',
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductTypeDto::fromModel($productType);
    }

    public function testFromModelWithNameAndTaxIncorrect()
    {
        $productType = [
            'name' => 12,
            'tax' => 'Twelve',
        ];

        $this->expectException(\InvalidArgumentException::class);

        ProductTypeDto::fromModel($productType);
    }
}