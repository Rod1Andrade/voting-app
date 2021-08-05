<?php

use Rodri\SimpleRouter\Helpers\Header;
use Rodri\SimpleRouter\Router;

$router = new Router();

# Settings
$router->debug(getenv('DEV_MODE'));
//$router->headerConfigs([
//    Header::APPLICATION_JSON_UTF8
//]);

$router->setControllerNamespace('Rodri\VotingApp\App\Http\Controllers');
$router->setMiddlewareNamespace('Rodri\VotingApp\App\Http\Middlewares');

#### Routes ####

/** ***************************************************
 *  Authentication
 ****************************************************/
$router->group(['/auth'], function (Router $router) {
    $router->post(['/signUp'], 'AuthController#registerUser');
    $router->post(['/signIn'], 'AuthController#authenticateUser');
});

/** ***************************************************
 *  Voting Section
 ****************************************************/
$router->group(['/voting', 'middleware' => 'SecurityMiddleware'], function (Router $router) {
    $router->get(['/section'], 'VotingSectionController#showAllVotingSections');
    $router->get(['/section/:offset/:limit'], 'VotingSectionController#showAllVotingSections');
    $router->get(['/section/:votingSectionUuid'], 'VotingSectionController#showVotingSection');

    $router->post(['/section'], 'VotingSectionController#createVotingSection');
    $router->delete(['/section/:votingSectionUuid'], 'VotingSectionController#deleteVotingSection');

    $router->patch(['/option/:votingOptionUuid'], 'VotingOptionController#updateVotingOptionTitle');
    $router->delete(['/option/:votingOptionUuid'], 'VotingOptionController#deleteVotingOption');
});

/** ***************************************************
 *  Vote
 ****************************************************/
$router->group(['/vote', 'middleware' => 'SecurityMiddleware'], function (Router $router) {
    $router->post(['/'], 'VoteController#userVote');
});

# Dispatcher
$router->dispatch();
