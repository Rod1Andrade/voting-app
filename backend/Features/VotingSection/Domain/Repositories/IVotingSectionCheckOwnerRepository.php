<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Repository - IVotingSectionCheckOwnerRepository
 * @author Rodrigo Andrade
 */
interface IVotingSectionCheckOwnerRepository
{
    /**
     * @param VotingUuid $votingUuid
     * @param UserUuid   $userUuid
     * @return bool
     */
    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): bool;
}
