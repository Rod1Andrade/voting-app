<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

interface IShowAllVotingSectionsDataLayer
{
    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function __invoke(int $offset, int $limit): array;
}