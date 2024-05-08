<?php

namespace App\tests\unit\controllers;

use PHPUnit\Framework\TestCase;
use App\controllers\DefaultController;

class DefaultControllerTest extends TestCase
{
    public function testActionIndex()
    {
        $result = (new DefaultController())->index();

        $this->assertEquals(json_encode('home'), $result);
    }
}