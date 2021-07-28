<?php

use Rodri\SimpleRouter\Helpers\Header;
use Rodri\SimpleRouter\Router;

$router = new Router();

# Settings
$router->debug(getenv('DEV_MODE'));
$router->headerConfigs([
    Header::APPLICATION_JSON_UTF8
]);

$router->setControllerNamespace('Rodri\VotingApp\App\Http\Controllers');
$router->setMiddlewareNamespace('Rodri\VotingApp\App\Http\Middlewares');

# Routes
$router->group(['/auth'], function (Router $router) {
    $router->post(['/signUp'], 'AuthController#registerUser');
    $router->post(['/signIn'], 'AuthController#authenticateUser');
});

# Dispatcher
$router->dispatch();
