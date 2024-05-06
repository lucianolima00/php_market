<?php

namespace App\controllers;

use Exception;
use App\models\Product;
use App\dtos\ProductDto;
use App\services\ProductService;

class ProductController
{
    public function index()
    {
        $products = ProductService::all();

        echo json_encode($products);
    }

    public function show($args)
    {
        $product = ProductService::one([$args->first, $args->next]);

        echo(json_encode($product));
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            $product = ProductService::store(ProductDto::fromModel($request));

            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function update($args)
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            $product = ProductService::update($args->first, ProductDto::fromModel($request));

            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new Product();
            $product = $model->delete($args->first);

            echo json_encode($product);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }
}