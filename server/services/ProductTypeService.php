<?php

namespace App\services;

use App\models\ProductType;
use App\dtos\ProductTypeDto;

class ProductTypeService
{
    public static function store(ProductTypeDto $dto)
    {
        $productType = new ProductType();

        $productTypeId = $productType->create([
            'name' => $dto->name,
            'tax' => $dto->tax,
        ]);

        return $productTypeId;
    }

    public static function update($id, ProductTypeDto $dto)
    {
        $productType = new ProductType();

        $productTypeId = $productType->update($id, [
            'name' => $dto->name,
            'tax' => $dto->tax,
        ]);

        return $productTypeId;
    }
}