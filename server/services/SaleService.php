<?php

namespace App\services;

use App\models\Sale;
use App\dtos\SaleDto;
use App\models\SaleProduct;

class SaleService
{
    public static function all()
    {
        $model = new Sale();

        return $model->all();
    }

    public static function one($args)
    {
        $model = new Sale();
        $sale = $model->findOne($args[0]);

        if ($args[1] == 'products') {
            $modelSaleProduct = new SaleProduct();
            $sale->products = $modelSaleProduct->find(['sale_id' => $sale->id]);
        }

        return $sale;
    }

    public static function store(SaleDto $dto)
    {
        if (!empty($dto->products)) {
            $sale = new Sale();

            $total_value = 0;
            $total_tax = 0;
            foreach ($dto->products as $product) {
                $value = $product->unit_value * $product->quantity;
                $total_tax += $value * ($product->tax / 100);
                $total_value += $value;
                $product->total = $value;
            }

            $saleId = $sale->create([
                'subject' => $dto->subject,
                'total_value' => $total_value,
                'total_tax' => $total_tax,
            ]);

            foreach ($dto->products as $product) {
                $saleProduct = new SaleProduct();
                $saleProduct->create([
                    'sale_id' => $saleId,
                    'product_id' => $product->product_id,
                    'quantity' => $product->quantity,
                    'unit_value' => $product->unit_value,
                    'total' => $product->total,
                ]);
            }

            return $saleId;
        }

        return false;
    }

    public static function update($id, SaleDto $dto)
    {
        if (!empty($dto->products)) {
            $sale = new Sale();

            $total_value = 0;
            $total_tax = 0;
            foreach ($dto->products as $product) {
                $value = $product->unit_value * $product->quantity;
                $total_tax += $value * $product->tax;
                $total_value += $value;
                $product->total = $value;
            }

            $saleId = $sale->update($id, [
                'subject' => $dto->subject,
                'total_value' => $total_value,
                'total_tax' => $total_tax,
            ]);

            $modelSaleProduct = new SaleProduct();

            if ($saleProducts = $modelSaleProduct->find(['sale_id' => $saleId])) {
                foreach ($saleProducts as $saleProduct) {
                    $modelSaleProduct->delete(['sale_id' => $saleId, 'product_id' => $saleProduct->product_id]);
                }
            }

            foreach ($dto->products as $product) {
                $modelSaleProduct->create([
                    'sale_id' => $saleId,
                    'product_id' => $product->product_id,
                    'quantity' => $product->quantity,
                    'unit_value' => $product->unit_value,
                    'total' => $product->total,
                ]);
            }

            return $saleId;
        }

        return false;
    }
}