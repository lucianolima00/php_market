<?php

namespace App\services;

use App\models\ProductType;
use App\dtos\ProductTypeDto;

class ProductTypeService
{
    public static function all()
    {
        $model = new ProductType();

        return $model->all();
    }

    public static function one($args)
    {
        $model = new ProductType();

        return $model->findOne($args[0]);
    }

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