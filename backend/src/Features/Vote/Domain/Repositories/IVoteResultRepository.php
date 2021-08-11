<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Repositories;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Repository - IVoteResultRepository
 * @author Rodrigo Andrade
 */
interface IVoteResultRepository
{
    public function __invoke(VotingUuid $votingUuid): Vote;
}