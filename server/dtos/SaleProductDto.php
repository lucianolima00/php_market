<?php

namespace App\dtos;

use InvalidArgumentException;

class SaleProductDto
{
    public int $product_id;
    public float $quantity;
    public float $unit_value;
    public float $tax;
    public int|null $sale_id = null;
    public float|null $total = null;

    public function __construct(
        int $product_id,
        float $quantity,
        float $unit_value,
        float $tax,
        ?int $sale_id,
        ?float $total
    )
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->unit_value = $unit_value;
        $this->tax = $tax;
        $this->sale_id = $sale_id;
        $this->total = $total;
    }

    public static function fromModel($request)
    {
        if (!isset($request["product_id"]) || !isset($request["quantity"]) || !isset($request["unit_value"]) || !isset($request["tax"])) {
            throw new InvalidArgumentException("Missing required fields in request.");
        }

        if (!is_int($request["product_id"])) {
            throw new InvalidArgumentException("Invalid type for 'product_id'. Expected integer.");
        }

        if (!is_float($request["quantity"])) {
            throw new InvalidArgumentException("Invalid type for 'quantity'. Expected float.");
        }

        if (!is_float($request["unit_value"])) {
            throw new InvalidArgumentException("Invalid type for 'unit_value'. Expected float.");
        }

        if (!is_float($request["tax"])) {
            throw new InvalidArgumentException("Invalid type for 'tax'. Expected float.");
        }

        if (isset($request["sale_id"]) && !is_int($request["sale_id"])) {
            throw new InvalidArgumentException("Invalid type for 'sale_id'. Expected integer.");
        }

        if (isset($request["total"]) && !is_float($request["total"])) {
            throw new InvalidArgumentException("Invalid type for 'total'. Expected float.");
        }

        return new self($request["product_id"], $request["quantity"], $request["unit_value"], $request["tax"], $request["sale_id"] ?? null, $request["total"] ?? null);
    }
}