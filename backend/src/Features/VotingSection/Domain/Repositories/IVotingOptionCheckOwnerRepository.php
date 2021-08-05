<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Repository - IVotingOptionCheckOwnerRepository
 * @author Rodrigo Andrade
 */
interface IVotingOptionCheckOwnerRepository
{
    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     * @return bool
     */
    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): bool;
}