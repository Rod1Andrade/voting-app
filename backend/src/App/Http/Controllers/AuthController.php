<?php


namespace Rodri\VotingApp\App\Http\Controllers;

use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidEmailException;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\External\Factories\UseCaseFactory;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;

/**
 * Controller - AuthController
 * @package Rodri\VotingApp\App\Http\Controllers
 * @author Rodrigo Andrade
 */
class AuthController
{
    /**
     * Register user Method
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request): Response
    {
        # Request data
        $userDTO = UserDTO::factoryUserDTOFromStdClass(json_decode($request->body()));

        # use case
        $registerUserUseCase = UseCaseFactory::registerUserUseCase(PgConnection::getConnection());

        # Register user
        try {
            $registerUserUseCase(UserDTO::FactoryUserFromDTO($userDTO));
        } catch (RegisterUserException | RegisterUserDataLayerException | InvalidEmailException $e) {
            return new Response([$e->getMessage()], StatusCode::BAD_REQUEST);
        }

        return new Response('');
    }
}