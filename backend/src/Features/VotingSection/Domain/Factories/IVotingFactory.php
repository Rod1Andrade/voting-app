<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\Factories;


use DateTime;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;

/**
 * Interface IVotingFactory
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Factories
 * @author Rodrigo Andrade
 */
interface IVotingFactory
{
    /**
     * Usually this method work to set the voting uuid for any voting options.
     * @param string $subject
     * @param DateTime $startDate
     * @param DateTime $finishDate
     * @param array $votingOptions
     * @return Voting
     */
    public static function create(string $subject, DateTime $startDate, DateTime $finishDate, array $votingOptions): Voting;
}