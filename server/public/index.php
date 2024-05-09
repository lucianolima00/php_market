<?php

use App\App;

require "bootstrap.php";

$config = require 'config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: *");

(new App($config))->run();