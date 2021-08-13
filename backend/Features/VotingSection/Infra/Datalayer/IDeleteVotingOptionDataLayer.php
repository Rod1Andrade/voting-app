<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

/**
 * Data Layer - IDeleteVotingOptionDataLayer
 * @author Rodrigo Andrade
 */
interface IDeleteVotingOptionDataLayer
{
    /**
     * Delete a voting option in data source.
     * @param string $votingOptionUuid
     */
    public function __invoke(string $votingOptionUuid): void;
}
