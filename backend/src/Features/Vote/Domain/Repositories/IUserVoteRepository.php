<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Repository - IUserVoteRepository
 * @author Rodrigo Andrade
 */
interface IUserVoteRepository
{
    /**
     * Store the vote of a user.
     * @param UserUuid $userUuid
     * @param VotingUuid $votingUuid
     * @param VotingOptionUuid $votingOptionUuid
     */
    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void;
}