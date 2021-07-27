<?php


namespace Rodri\VotingApp\Features\Auth\External\Facades;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\AuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IAuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\External\DataLayer\AuthenticateUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\AuthenticateUserRepository;

class AuthenticateUserUseCaseFacade
{
    /**
     * Create a Authenticate User Use Case
     * @param Connection $connection
     * @return IAuthenticateUserUseCase
     */
    #[Pure] public function createUseCase(Connection $connection): IAuthenticateUserUseCase
    {
        $dataLayer = new AuthenticateUserDataLayer($connection);
        $repository = new AuthenticateUserRepository($dataLayer);

        return new AuthenticateUserUseCase($repository);
    }
}