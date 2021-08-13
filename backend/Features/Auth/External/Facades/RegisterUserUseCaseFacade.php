<?php


namespace Rodri\VotingApp\Features\Auth\External\Facades;

use Illuminate\Database\Connection;
use JetBrains\PhpStorm\Pure;
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
     * @return IRegisterUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public function createUseCase(): IRegisterUserUseCase
    {
        $dataLayer = new RegisterUserDataLayer();
        $repository = new RegisterUserRepository($dataLayer);

        return new RegisterUserUseCase($repository);
    }
}
