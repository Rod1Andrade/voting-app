<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

/**
 * DataLayer - IVotingOptionCheckOwnerDatalayer
 * @author Rodrigo Andrade
 */
interface IVotingOptionCheckOwnerDatalayer
{
    /**
     * @param string $votingOptionUuid
     * @param string $userUuid
     * @return bool
     */
    public function __invoke(string $votingOptionUuid, string $userUuid): bool;
}