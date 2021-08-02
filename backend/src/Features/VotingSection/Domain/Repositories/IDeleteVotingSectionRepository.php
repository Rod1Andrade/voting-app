<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

interface IDeleteVotingSectionRepository
{
    /**
     * Delete the voting and all yours voting options by voting uuid.
     * @param VotingUuid $votingUuid
     */
    public function __invoke(VotingUuid $votingUuid): void;
}