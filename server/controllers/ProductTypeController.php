<?php

namespace App\controllers;

use Exception;
use App\models\ProductType;
use App\dtos\ProductTypeDto;
use App\services\ProductTypeService;

class ProductTypeController
{
    public function __construct(
        private ProductTypeService $productTypeService
    )
    {
    }

    public function index()
    {
        $products = $this->productTypeService->all();

        return  json_encode($products);
    }

    public function show($args)
    {
        $product = $this->productTypeService->one([$args->first, $args->next]);

        return json_encode($product);
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            $product = $this->productTypeService->store(ProductTypeDto::fromModel($request));

            return  json_encode($product);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }

    public function update($args)
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            $product = $this->productTypeService->update($args->first, ProductTypeDto::fromModel($request));

            return  json_encode($product);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new ProductType();
            $product = $model->delete($args->first);
            return  json_encode($product);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }
}