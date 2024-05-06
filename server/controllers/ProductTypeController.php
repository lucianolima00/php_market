<?php

namespace App\controllers;

use Exception;
use App\models\ProductType;
use App\dtos\ProductTypeDto;
use App\services\ProductTypeService;

class ProductTypeController
{
    public function index()
    {
        $model = new ProductType();
        $products = $model->all();

        echo json_encode($products);
    }

    public function show($args)
    {
        $model = new ProductType();
        $product = $model->find($args->first);

        echo(json_encode($product));
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            $product = ProductTypeService::store(ProductTypeDto::fromModel($request));

            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function update($args)
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            $product = ProductTypeService::update($args->first, ProductTypeDto::fromModel($request));

            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new ProductType();
            $product = $model->delete($args->first);
            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }
}