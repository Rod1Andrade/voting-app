<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataLayers;

/**
 * Data Layer - ICheckUserAlreadyVoteDataLayer
 * @author Rodrigo Andrade
 */
interface ICheckUserAlreadyVoteDataLayer
{
    /**
     * @param string $userUuid
     * @param string $votingUuid
     * @return bool
     */
    public function __invoke(string $userUuid, string $votingUuid): bool;
}