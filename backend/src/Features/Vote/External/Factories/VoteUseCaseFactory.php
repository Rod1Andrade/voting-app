<?php

namespace Rodri\VotingApp\Features\Vote\External\Factories;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Vote\External\Facades\UserVoteUseCaseFacade;

/**
 * Factory - VoteUseCaseFactory
 * @author Rodrigo Andrade
 */
class VoteUseCaseFactory implements IVoteUseCaseFactory
{
    public static function userVoteUseCase(Connection $connection, string $schema = 'voting.')
    {
        return (new UserVoteUseCaseFacade())->createUseCase($connection, $schema);
    }
}