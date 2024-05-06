<?php

namespace App\dtos;

use InvalidArgumentException;

class ProductDto
{
    public string $name;
    public string|null $description;
    public float $value;
    public float $product_type_id;

    public function __construct(
        string $name,
        float $value,
        float $product_type_id,
        ?string $description = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->product_type_id = $product_type_id;
    }

    public static function fromModel($request)
    {
        if (!isset($request["name"]) || !isset($request["value"]) || !isset($request["product_type_id"])) {
            throw new InvalidArgumentException("Missing required fields in sale request.");
        }

        if (!is_string($request["name"])) {
            throw new InvalidArgumentException("Invalid type for 'name'. Expected string or null.");
        }

        if (isset($request["description"]) && !is_string($request["description"]) && $request["description"] !== null) {
            throw new InvalidArgumentException("Invalid type for 'description'. Expected string or null.");
        }

        if (!is_float($request["value"])) {
            throw new InvalidArgumentException("Invalid type for 'value'. Expected float.");
        }

        if (!is_integer($request["product_type_id"])) {
            throw new InvalidArgumentException("Invalid type for 'product_type_id'. Expected integer.");
        }

        return new self($request["name"], $request["description"], $request["value"], $request["product_type_id"]);
    }
}