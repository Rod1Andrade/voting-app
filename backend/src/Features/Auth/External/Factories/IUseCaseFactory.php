<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IAuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;

interface IUseCaseFactory
{
    /**
     * @param Connection $connection
     * @return IRegisterUserUseCase
     */
    public static function registerUserUseCase(Connection $connection): IRegisterUserUseCase;

    /**
     * @param Connection $connection
     * @return IAuthenticateUserUseCase
     */
    public static function authenticateUserUseCase(Connection $connection): IAuthenticateUserUseCase;
}