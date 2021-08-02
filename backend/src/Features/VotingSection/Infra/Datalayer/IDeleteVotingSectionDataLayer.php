<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

/**
 * Interface IDeleteVotinSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\Infra\Datalayer
 * @author Rodrigo Andrade
 */
interface IDeleteVotingSectionDataLayer
{
    /**
     * Delete a voting section with uuid passed by arguments.
     * @param string $votingUuid
     */
    public function __invoke(string $votingUuid): void;
}