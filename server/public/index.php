<?php

use App\App;

require "bootstrap.php";

$config = require 'config.php';

(new App($config))->run();