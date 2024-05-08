<?php

namespace App\dtos;

use InvalidArgumentException;

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
        if (!isset($request["name"]) || !isset($request["tax"])) {
            throw new InvalidArgumentException("Missing required fields in product type request.");
        }

        if (!is_string($request["name"])) {
            throw new InvalidArgumentException("Invalid type for 'name'. Expected string.");
        }

        if (!is_float($request["tax"])) {
            throw new InvalidArgumentException("Invalid type for 'tax'. Expected float.");
        }

        return new self($request["name"], $request["tax"]);
    }
}