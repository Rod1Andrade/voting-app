<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

interface IDeleteVotingSectionRepository
{
    /**
     * Delete the voting and all yours voting options by voting uuid.
     * @param VotingUuid $votingUuid
     * @param UserUuid $userUuid
     */
    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): void;
}