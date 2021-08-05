<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use RuntimeException;

/**
 * Repository ICreatedVotingSectionRepository
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Repositories
 * @author Rodrigo Andrade
 */
interface ICreateVotingSectionRepository
{
    /**
     * @param Voting $voting
     * @throws RuntimeException
     */
    public function __invoke(Voting $voting): void;
}