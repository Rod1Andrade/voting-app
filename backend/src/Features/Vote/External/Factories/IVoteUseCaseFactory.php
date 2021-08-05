<?php

namespace Rodri\VotingApp\Features\Vote\External\Factories;

use Rodri\VotingApp\App\Database\Connection\Connection;

/**
 * Factory - IVoteUseCaseFactory
 */
interface IVoteUseCaseFactory
{
    /**
     * Compute a vote in some voting option.
     *
     * @param Connection $connection
     * @param string $schema
     * @return mixed
     */
    public static function userVoteUseCase(Connection $connection, string $schema = 'voting.');
}