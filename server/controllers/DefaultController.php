<?php

namespace App\controllers;

use App\models\Sale;

class DefaultController
{
    public function index()
    {
        $sale = new Sale();
        $sales = $sale->all();

        echo json_encode($sales);
    }
}