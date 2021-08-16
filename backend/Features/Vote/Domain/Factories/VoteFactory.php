<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Factories;

use DateTime;
use Exception;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Implements IVoteFactory
 * @author Rodrigo Andrade
 */
class VoteFactory implements IVoteFactory
{

    /**
     * @throws Exception
     */
    public static function create(
        ?string $votingUuid = null,
        ?string $startDate = null,
        ?string $finishDate = null,
        ?string $subject = null,
        ?array  $voteResults = null
    ): Vote
    {
        return new Vote(
            votingUuid: new VotingUuid($votingUuid),
            startDate: new DateTime($startDate),
            finishDate: new DateTime($finishDate),
            subject: new Subject($subject),
            voteResults: $voteResults
        );
    }
}
