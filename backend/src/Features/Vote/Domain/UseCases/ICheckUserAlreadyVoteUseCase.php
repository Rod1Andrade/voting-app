<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Check if you use already vote in some Voting Section
 *
 * @author Rodrigo Andrade
 */
interface ICheckUserAlreadyVoteUseCase
{

    /**
     * @param UserUuid $userUuid
     * @param VotingUuid $votingUuid
     * @return bool
     */
    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid): bool;
}