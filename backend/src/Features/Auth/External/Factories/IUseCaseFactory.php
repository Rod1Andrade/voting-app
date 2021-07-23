<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;

interface IUseCaseFactory
{
    public static function registerUserUseCase(): IRegisterUserUseCase;
}