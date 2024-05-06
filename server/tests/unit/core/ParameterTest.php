<?php

namespace App\tests\unit\core;

use App\core\Method;
use App\core\Parameter;
use App\core\Controller;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testLoadParameterWithNoParameter(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale';
        $parameter = new Parameter();

        $result = $parameter->load();

        $expected = 'index';
        $this->assertEquals($expected, $result);
    }

    public function testLoadParameterWithOneParameter(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale/show/1';
        $parameter = new Parameter();

        $result = $parameter->load();

        $expected = (object)[
            'first' => '1',
            'next' => '1',
        ];
        $this->assertEquals($expected, $result);
    }

    public function testLoadMethodWithNonExistentMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/sale/show/1/products';
        $parameter = new Parameter();

        $result = $parameter->load();

        $expected = (object)[
            'first' => '1',
            'next' => 'products',
        ];
        $this->assertEquals($expected, $result);
    }
}