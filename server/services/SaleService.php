<?php

namespace App\services;

use App\models\Sale;
use App\dtos\SaleDto;

class SaleService
{
    public static function store(SaleDto $dto)
    {
        $sale = new Sale();

        $saleId = $sale->create([
            'subject' => $dto->subject,
            'total_value' => $dto->total_value,
            'total_tax' => $dto->total_tax,
        ]);

         return $saleId;
    }

    public static function update($id, SaleDto $dto)
    {
        $sale = new Sale();

        $saleId = $sale->update($id, [
            'subject' => $dto->subject,
            'total_value' => $dto->total_value,
            'total_tax' => $dto->total_tax,
        ]);

        return $saleId;
    }
}