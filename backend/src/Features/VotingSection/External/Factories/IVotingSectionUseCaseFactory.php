<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;

interface IVotingSectionUseCaseFactory
{
    /**
     * @param Connection $connection
     * @return ICreateVotingSectionUseCase
     */
    public static function createVotingSectionUseCase(Connection $connection, string $schema = ''): ICreateVotingSectionUseCase;
}