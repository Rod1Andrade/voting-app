<?php

namespace Rodri\VotingApp\Features\Vote\External\Factories;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\IUserVoteUseCase;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\IVoteResultUseCase;
use Rodri\VotingApp\Features\Vote\External\Facades\UserVoteUseCaseFacade;
use Rodri\VotingApp\Features\Vote\External\Facades\VoteResultUseCaseFacade;

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

    #[Pure] public static function voteResultUseCase(string $schema = 'voting.'): IVoteResultUseCase
    {
        return (new VoteResultUseCaseFacade())->createUseCase($schema);
    }
}
