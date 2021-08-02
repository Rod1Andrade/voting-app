<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

/**
 * Interface IShowAllVotingSectionsUseCase
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface IShowAllVotingSectionsUseCase
{
    /**
     * Show all Voting sections.
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function __invoke(int $offset = 1, int $limit = 10): array;
}