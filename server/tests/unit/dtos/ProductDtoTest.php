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
            'value' => 123,
            'product_type_id' => 1
        ];

        $dto = ProductDto::fromModel($product);

        $this->assertEquals('Test', $dto->name);
    }
}