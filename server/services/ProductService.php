<?php

namespace App\services;

use App\models\Product;
use App\dtos\ProductDto;
use App\models\ProductType;

class ProductService
{
    public function all()
    {
        $model = new Product();
        return $model->all();
    }

    public function one($args)
    {
        $model = new Product();
        $product = $model->findOne($args[0]);

        if ($args[1] == 'productType') {
            $modelSaleProduct = new ProductType();
            $product->productType = $modelSaleProduct->find(['id' => $product->product_type_id]);
        }

        return $product;
    }

    public function store(ProductDto $dto)
    {
        $product = new Product();

        $productId = $product->create([
            'name' => $dto->name,
            'description' => $dto->description,
            'value' => $dto->value,
            'product_type_id' => $dto->product_type_id,
        ]);

        return $productId;
    }

    public function update($id, ProductDto $dto)
    {
        $product = new Product();

        $productId = $product->update($id, [
            'name' => $dto->name,
            'description' => $dto->description,
            'value' => $dto->value,
            'product_type_id' => $dto->product_type_id,
        ]);

        return $productId;
    }
}