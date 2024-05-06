<?php

namespace App\dtos;

use InvalidArgumentException;

class SaleDto
{
    public string|null $subject;
    /** @var SaleProductDto[] */
    public array $products;

    public function __construct(
        ?string $subject,
        array $products
    )
    {
        $this->subject = $subject;
        $this->products = $products;
    }

    public static function fromModel($request)
    {
        if (!isset($request["subject"]) || !isset($request["products"])) {
            throw new InvalidArgumentException("Missing required fields in sale request.");
        }

        if (!is_string($request["subject"]) && $request["subject"] !== null) {
            throw new InvalidArgumentException("Invalid type for 'subject'. Expected string or null.");
        }

        if (!is_array($request["products"])) {
            throw new InvalidArgumentException("Invalid type for 'products'. Expected array.");
        }

        foreach ($request["products"] as $product) {
            if (!($product instanceof SaleProductDto)) {
                throw new InvalidArgumentException("Invalid type for product in 'products' array. Expected SaleProductDto.");
            }
        }

        return new self($request["subject"], $request["products"]);
    }
}