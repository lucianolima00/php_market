<?php

namespace App\controllers;

use Exception;
use App\models\Sale;
use App\dtos\SaleDto;
use App\services\SaleService;

class SaleController
{
    public function index()
    {
        $model = new Sale();
        $sales = $model->all();

        echo json_encode($sales);
    }

    public function show($args)
    {
        $model = new Sale();
        $sale = $model->find($args->first);

        echo(json_encode($sale));
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

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