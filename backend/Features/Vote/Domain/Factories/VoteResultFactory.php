<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Factories;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Entities\VoteResult;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingOptionUuid;

/***
 * Implements Factory - IVoteFactory
 * @author Rodrigo Andrade
 */
class VoteResultFactory implements IVoteResultFactory
{
    #[Pure] public static function create(
        ?string $votingOptionUuid = null,
        ?string $title = null,
        ?int    $quantity = null
    ): VoteResult
    {
        return new VoteResult(
            votingOptionUuid: new VotingOptionUuid($votingOptionUuid),
            title: new Title($title),
            quantity: $quantity
        );
    }


}
