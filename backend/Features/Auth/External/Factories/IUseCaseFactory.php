<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use Rodri\VotingApp\Features\Auth\Domain\UseCases\IAuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;

interface IUseCaseFactory
{
    /**
     * @return IRegisterUserUseCase
     */
    public static function registerUserUseCase(): IRegisterUserUseCase;

    /**
     * @return IAuthenticateUserUseCase
     */
    public static function authenticateUserUseCase(): IAuthenticateUserUseCase;
}
