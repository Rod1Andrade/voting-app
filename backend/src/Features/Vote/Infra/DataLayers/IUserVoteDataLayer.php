<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataLayers;

/**
 * Data Layer - IUserVoteDataLayer
 * @author Rodrigo Andrade
 */
interface IUserVoteDataLayer
{
    /**
     * @param string $userUuid
     * @param string $votingUuid
     * @param string $votingOptionUuid
     */
    public function __invoke(string $userUuid, string $votingUuid, string $votingOptionUuid): void;
}