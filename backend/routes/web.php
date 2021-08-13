<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/** ***************************************************
*  Authentication
****************************************************/
$router->group([
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function () use ($router) {
    $router->post('signUp', ['uses' => 'RegisterUserController@invoke']);
    $router->post('signIn', ['uses' => 'AuthenticateUserController@invoke']);
});

/** ***************************************************
 *  Voting Section - Voting
 ****************************************************/
$router->group([
    'prefix' => 'voting-section',
    'namespace' => 'VotingSection',
    'middleware' => 'auth'
], function() use($router) {
    $router->get('', 'ShowAllVotingSectionsController@invoke');
    $router->get('{votingUuid}', 'ShowVotingSectionController@invoke');
    $router->post('', 'CreateVotingSectionController@invoke');
    $router->delete('{votingUuid}', 'DeleteVotingSectionController@invoke');

});

/** ***************************************************
 *  Voting Section - Voting Option
 ****************************************************/
$router->group([
    'prefix' => 'voting-option',
    'namespace' => 'VotingSection',
    'middleware' => 'auth'
], function() use($router) {
    $router->patch('{votingOptionUuid}', 'UpdateVotingOptionTitleController@invoke');
    $router->delete('{votingOptionUuid}', 'DeleteVotingOptionController@invoke');
});

