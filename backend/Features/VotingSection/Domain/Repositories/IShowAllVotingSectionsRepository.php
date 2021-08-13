<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

/**
 * Repository IShowAllVotingSectionRepository
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Repositories
 * @author Rodrigo Andrade
 */
interface IShowAllVotingSectionsRepository
{
    /**
     * Get all voting
     * @param int $offset
     * @param int $limit
     * @return array Voting
     */
    public function __invoke(int $offset, int $limit): array;
}