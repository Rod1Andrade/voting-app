<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;


use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Interface IShowVotingSectionUseCase
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface IShowVotingSectionUseCase
{
    /**
     * Get a voting by Voting UUID
     *
     * @param VotingUuid $votingUuid
     * @return Voting
     */
    public function __invoke(VotingUuid $votingUuid): Voting;
}