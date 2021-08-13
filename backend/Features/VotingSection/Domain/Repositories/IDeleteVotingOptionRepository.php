<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Repository - IDeleteVotingOptionRepository
 * @author Rodrigo Andrade
 */
interface IDeleteVotingOptionRepository
{
    /**
     * Delete a voting option.
     * @param VotingOptionUuid $votingOptionUuid
     */
    public function __invoke(VotingOptionUuid $votingOptionUuid): void;
}
