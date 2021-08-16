<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Use Case - IVoteResultUseCase
 * @author Rodrigo Andrade
 */
interface IVoteResultUseCase
{
    /**
     * Get the vote result
     *
     * @param VotingUuid $votingUuid
     * @return Vote|null
     */
    public function __invoke(VotingUuid $votingUuid): ?Vote;
}
