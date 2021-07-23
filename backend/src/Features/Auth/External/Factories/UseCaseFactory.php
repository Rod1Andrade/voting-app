<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\External\Facades\RegisterUserUseCaseFacade;

class UseCaseFactory implements IUseCaseFactory
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
}