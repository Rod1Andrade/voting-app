<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Repository IShowVotingSectionRepository
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Repositories
 * @author Rodrigo Andrade
 */
interface IShowVotingSectionRepository
{
    /**
     * @param VotingUuid $votingUuid
     * @return Voting
     */
    public function __invoke(VotingUuid $votingUuid): Voting;
}