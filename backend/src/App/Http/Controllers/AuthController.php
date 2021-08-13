<?php


namespace Rodri\VotingApp\App\Http\Controllers;

use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\App\Http\Security\JwToken;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidEmailException;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\External\Factories\AuthUseCaseFactory;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;
use RuntimeException;

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
     * @codeCoverageIgnore
     * @throws Exception
     */
    public function registerUser(Request $request): Response
    {
        
        # Request data
        $userDTO = UserDTO::factoryUserDTOFromStdClass(json_decode($request->body()));

        # use case
        $registerUserUseCase = AuthUseCaseFactory::registerUserUseCase(PgConnection::getConnection());

        # Register user
        try {
            $registerUserUseCase(UserDTO::FactoryUserFromDTO($userDTO));
        } catch (RegisterUserException | RegisterUserDataLayerException | InvalidEmailException $e) {
            return new Response([$e->getMessage()], StatusCode::BAD_REQUEST);
        }

        return new Response('');
    }

    /**
     * Authenticate a user
     * @param Request $request
     * @return Response
     * @throws Exception
     * @codeCoverageIgnore
     */
    public function authenticateUser(Request $request): Response
    {
        $authenticateUserUseCase = AuthUseCaseFactory::authenticateUserUseCase(PgConnection::getConnection());

        try {
            $userUuid = $authenticateUserUseCase(
                email: new Email($request->input('email')),
                password: new Password($request->input('password'))
            );

            return new Response(['token' => JwToken::encode([
                'sub' => $userUuid->getValue()
            ])]);

        } catch (RuntimeException|Exception $e) {
            return new Response([$e->getMessage()], StatusCode::BAD_REQUEST);
        }
    }
}