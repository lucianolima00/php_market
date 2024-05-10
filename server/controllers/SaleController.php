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
    public function __construct(
        private SaleService $saleService
    )
    {
    }

    public function index()
    {
        $sales = $this->saleService->all();
        return json_encode($sales);
    }

    public function show($args)
    {
        $sale = $this->saleService->one([$args->first, $args->next]);
        return json_encode($sale);
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

            $sale = $this->saleService->store(SaleDto::fromModel($request));

            return json_encode($sale);
        } catch (\Exception $e) {
            return ($e->getMessage());
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

            $sale = $this->saleService->update($args->first, SaleDto::fromModel($request));

            return json_encode($sale);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }

    public function destroy($args)
    {
        try {
            $model = new Sale();
            $sale = $model->delete($args->first);
            return json_encode($sale);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }
}