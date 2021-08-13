<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

/**
 * DataLayer - IVotingSectionCheckOwnerDataLayer
 * @author Rodrigo Andrade
 */
interface IVotingSectionCheckOwnerDataLayer
{
    /**
     * @param string $votingUuid
     * @param string $userUuid
     * @return bool
     */
    public function __invoke(string $votingUuid, string $userUuid): bool;
}
