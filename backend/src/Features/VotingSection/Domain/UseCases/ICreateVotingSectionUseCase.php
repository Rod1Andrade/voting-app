<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;

/**
 * Interface ICreateVotingSection
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface ICreateVotingSectionUseCase
{
    /**
     * Created a VotingSection
     * @param Voting $voting Entity
     */
    public function __invoke(Voting $voting): void;
}