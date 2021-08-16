<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Factories;


use Rodri\VotingApp\Features\Vote\Domain\Entities\VoteResult;

/***
 * Factory - IVoteResultFactory
 * @author Rodrigo Andrade
 */
interface IVoteResultFactory
{
    /**
     * @param string|null $votingOptionUuid
     * @param string|null $title
     * @param int|null    $quantity
     * @return VoteResult
     */
    public static function create(
        ?string $votingOptionUuid = null,
        ?string $title = null,
        ?int $quantity = null,
    ): VoteResult;
}
