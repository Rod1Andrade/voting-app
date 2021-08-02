<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;

interface IVotingSectionUseCaseFactory
{
    /**
     * @param Connection $connection
     * @param string $schema
     * @return ICreateVotingSectionUseCase
     */
    public static function createVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): ICreateVotingSectionUseCase;

    /**
     * @param Connection $connection
     * @param string $schema
     * @return IDeleteVotingSectionUseCase
     */
    public static function deleteVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): IDeleteVotingSectionUseCase;
}