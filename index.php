<?php

require_once 'vendor/autoload.php';
require_once 'routes.php';

$kernel = new \AoC2023\Lib\Kernel();

registerRoutes($kernel);

$kernel->run();