<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
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
     * @param UserUuid $userUuid
     */
    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void;
}