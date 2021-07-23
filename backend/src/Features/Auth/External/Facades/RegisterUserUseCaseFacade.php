<?php


namespace Rodri\VotingApp\Features\Auth\External\Facades;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\RegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\External\DataLayer\RegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\RegisterUserRepository;

/**
 * Class RegisterUserUseCaseFacade
 * @package Rodri\VotingApp\Features\Auth\External\Facades
 */
class RegisterUserUseCaseFacade
{
    /**
     * @param Connection $connection
     * @return IRegisterUserUseCase
     */
    #[Pure] public function createUseCase(Connection $connection): IRegisterUserUseCase
    {
        $dataLayer = new RegisterUserDataLayer($connection);
        $repository = new RegisterUserRepository($dataLayer);

        return new RegisterUserUseCase($repository);
    }
}