<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Repositories;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;

/**
 * Repository - IUserVoteRepository
 * @author Rodrigo Andrade
 */
interface IUserVoteRepository
{
    /**
     * Store the vote of a user.
     * @param Vote $vote
     */
    public function __invoke(Vote $vote): void;
}