<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use JetBrains\PhpStorm\Pure;
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
     * @return IRegisterUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public static function registerUserUseCase(): IRegisterUserUseCase
    {
        return (new RegisterUserUseCaseFacade())->createUseCase();
    }

    /**
     * @return IAuthenticateUserUseCase
     * @codeCoverageIgnore
     */
    #[Pure] public static function authenticateUserUseCase(): IAuthenticateUserUseCase
    {
        return (new AuthenticateUserUseCaseFacade())->createUseCase();
    }
}
