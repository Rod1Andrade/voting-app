<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Repositories;

use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Repository - ICheckUserAlreadyVoteRepository
 * @author Rodrigo Andrade
 */
interface ICheckUserAlreadyVoteRepository
{

    /**
     * @param UserUuid $userUuid
     * @param VotingUuid $votingUuid
     * @return bool
     */
    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid): bool;
}