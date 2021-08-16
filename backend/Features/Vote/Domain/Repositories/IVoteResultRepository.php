<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Repositories;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Repository - IVoteResultRepository
 * @author Rodrigo Andrade
 */
interface IVoteResultRepository
{
    /**
     * @param VotingUuid $votingUuid
     * @return Vote|null
     */
    public function __invoke(VotingUuid $votingUuid): ?Vote;
}
