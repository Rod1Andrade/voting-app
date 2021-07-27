<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IAuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\External\Facades\AuthenticateUserUseCaseFacade;
use Rodri\VotingApp\Features\Auth\External\Facades\RegisterUserUseCaseFacade;

/**
 * Class UseCaseFactory
 * @package Rodri\VotingApp\Features\Auth\External\Factories
 * @author Rodrigo Andrade
 */
class AuthUseCaseFactory implements IUseCaseFactory
{

    /**
     * @param Connection $connection
     * @return IRegisterUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public static function registerUserUseCase(Connection $connection): IRegisterUserUseCase
    {
        return (new RegisterUserUseCaseFacade())->createUseCase($connection);
    }

    /**
     * @param Connection $connection
     * @return IAuthenticateUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public static function authenticateUserUseCase(Connection $connection): IAuthenticateUserUseCase
    {
        return (new AuthenticateUserUseCaseFacade())->createUseCase($connection);
    }
}