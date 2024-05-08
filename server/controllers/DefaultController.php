<?php

namespace App\controllers;

class DefaultController
{
    public function index()
    {
        return json_encode('home');
    }
}