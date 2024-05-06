<?php

namespace App\controllers;

use Exception;
use App\models\Sale;
use App\dtos\SaleDto;
use App\models\SaleProduct;
use App\dtos\SaleProductDto;
use App\services\SaleService;

class SaleController
{
    public function index()
    {
        $sales = SaleService::all();
        echo json_encode($sales);
    }

    public function show($args)
    {
        $sale = SaleService::one([$args->first, $args->next]);
        echo(json_encode($sale));
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            if (isset($request['products']) && is_array($request['products'])) {
                foreach ($request['products'] as $key => $product) {
                    $request['products'][$key] = SaleProductDto::fromModel($product);
                }
            }

            $sale = SaleService::store(SaleDto::fromModel($request));

            echo json_encode($sale);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function update($args)
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            if (isset($request['products']) && is_array($request['products'])) {
                foreach ($request['products'] as $key => $product) {
                    $request['products'][$key] = SaleProductDto::fromModel($product);
                }
            }

            $sale = SaleService::update($args->first, SaleDto::fromModel($request));

            echo json_encode($sale);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new Sale();
            $sale = $model->delete($args->first);
            echo json_encode($sale);
        } catch (\Exception $e) {
            echo($e->getMessage());
        }
    }
}