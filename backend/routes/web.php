<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/** ***************************************************
*  Authentication
****************************************************/
$router->group(['prefix' => 'auth','namespace' => 'Auth'], function () use ($router) {
    $router->post('signUp', ['uses' => 'RegisterUserController@invoke']);
    $router->post('signIn', ['uses' => 'AuthenticateUserController@invoke']);
});

/** ***************************************************
 *  Voting Section
 ****************************************************/
$router->group(['prefix' => 'voting', 'namespace' => 'VotingSection', 'middleware' => 'auth'], function() use($router) {
});
