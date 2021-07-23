<?php

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__.'/../src/App/Config');
$dotenv->load();

# Router
require_once __DIR__.'/../src/App/Http/Routes/route.php';
