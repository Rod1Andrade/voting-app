<?php


namespace Rodri\VotingApp\Features\Auth\External\Factories;


use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\IRegisterUserUseCase;

interface IUseCaseFactory
{
    public static function registerUserUseCase(Connection $connection): IRegisterUserUseCase;
}