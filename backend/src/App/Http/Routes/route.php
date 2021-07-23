<?php

use Rodri\SimpleRouter\Router;

$router = new Router();

# Settings
$router->debug(getenv('DEV_MODE'));
//$router->headerConfigs([
//    'Content-type: application/json;charset=utf-8'
//]);
$router->setControllerNamespace('Rodri\VotingApp\App\Http\Controllers');

# Routes
$router->group(['/auth'], function (Router $router) {
    $router->post(['/signup'], 'AuthController#registerUser');
});

# Dispatcher
$router->dispatch();
