<?php

namespace App\controllers;

use Exception;
use App\models\Product;
use App\dtos\ProductDto;
use App\services\ProductService;

class ProductController
{
    public function __construct(
        private ProductService $productService
    )
    {
    }

    public function index()
    {
        $products = $this->productService->all();

        return json_encode($products);
    }

    public function show($args)
    {
        $product = $this->productService->one([$args->first, $args->next]);

        return(json_encode($product));
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            var_dump($request);
            $product = $this->productService->store(ProductDto::fromModel($request));

            return json_encode($product);
        } catch (\Exception $e) {
            return($e->getMessage());
        }
    }

    public function update($args)
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            $product = $this->productService->update($args->first, ProductDto::fromModel($request));

            return json_encode($product);
        } catch (\Exception $e) {
            return($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new Product();
            $product = $model->delete($args->first);

            return json_encode($product);
        } catch (\Exception $e) {
            return($e->getMessage());
        }
    }
}