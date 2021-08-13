<?php

namespace Rodri\VotingApp\Features\Vote\External\Factories;

use Rodri\VotingApp\Features\Vote\Domain\UseCases\IUserVoteUseCase;
use Rodri\VotingApp\Features\Vote\External\Facades\UserVoteUseCaseFacade;

/**
 * Factory - VoteUseCaseFactory
 * @author Rodrigo Andrade
 */
class VoteUseCaseFactory implements IVoteUseCaseFactory
{
    public static function userVoteUseCase(string $schema = 'voting.'): IUserVoteUseCase
    {
        return (new UserVoteUseCaseFacade())->createUseCase($schema);
    }
}
