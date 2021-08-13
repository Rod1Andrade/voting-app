<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Use case - IVotingSectionCheckOwnerUseCase
 * @author Rodrigo Andrade
 */
interface IVotingSectionCheckOwnerUseCase
{
    /**
     * Check if the user is owner of this voting section.
     * @param VotingUuid $votingUuid
     * @param UserUuid   $userUuid
     * @return bool
     */
    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): bool;
}
