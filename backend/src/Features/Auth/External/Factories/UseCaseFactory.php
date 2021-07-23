<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\External\Facades\RegisterUserUseCaseFacade;

class UseCaseFactory implements IUseCaseFactory
{

    /**
     * @return IRegisterUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public static function registerUserUseCase(): IRegisterUserUseCase
    {
        return (new RegisterUserUseCaseFacade())->createUseCase();
    }
}