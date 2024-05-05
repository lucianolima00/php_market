<?php

namespace App\dtos;

class SaleDto
{
    public string|null $subject;
    public float $total_value;
    public float $total_tax;
    public array $products;

    public function __construct(
        ?string $subject,
        float $total_value,
        float $total_tax,
        array $products
    )
    {
        $this->subject = $subject;
        $this->total_value = $total_value;
        $this->total_tax = $total_tax;
        $this->products = $products;
    }

    public static function fromModel($request)
    {
        return new self($request["subject"], $request["total_value"], $request["total_tax"], $request["products"]);
    }
}