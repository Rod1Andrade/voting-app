<?php

namespace Rodri\VotingApp\Features\Vote\External\Factories;

use Rodri\VotingApp\Features\Vote\Domain\UseCases\IUserVoteUseCase;

/**
 * Factory - IVoteUseCaseFactory
 */
interface IVoteUseCaseFactory
{
    /**
     * Compute a vote in some voting option.
     *
     * @param string $schema
     * @return IUserVoteUseCase
     */
    public static function userVoteUseCase(string $schema = 'voting.'): IUserVoteUseCase;
}
