<?php

namespace App\dtos;

class ProductTypeDto
{
    public string $name;
    public float $tax;

    public function __construct(
        ?string $name,
        float $tax
    )
    {
        $this->name = $name;
        $this->tax = $tax;
    }

    public static function fromModel($request)
    {
        return new self($request["name"], $request["tax"]);
    }
}