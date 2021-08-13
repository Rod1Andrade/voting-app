<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;


/**
 * Use case - Delete Voting Sections
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface IDeleteVotingSectionUseCase
{

    /**
     * Delete a voting section and all voting options associated with.
     *
     * @param VotingUuid $votingUuid
     * @param UserUuid $userUuid
     */
    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): void;
}