<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * UseCase - Check the owner of a voting option
 * @author Rodrigo Andrade
 */
interface IVotingOptionCheckOwnerUseCase
{
    /**
     * Check if the voting option who try to be accessed has the same owner.
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     * @return bool
     */
    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): bool;
}