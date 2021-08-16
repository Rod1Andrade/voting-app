<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Factories;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;

/***
 * Factory - IVoteFactory
 * @author Rodrigo Andrade
 */
interface IVoteFactory
{
    /**
     * @param string|null $votingUuid
     * @param string|null $startDate
     * @param string|null $finishDate
     * @param string|null $subject
     * @param array|null  $voteResults
     * @return Vote
     */
    public static function create(
        ?string $votingUuid = null,
        ?string $startDate = null,
        ?string $finishDate = null,
        ?string $subject = null,
        ?array  $voteResults = null
    ): Vote;
}
