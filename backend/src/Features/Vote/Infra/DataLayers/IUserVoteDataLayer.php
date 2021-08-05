<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataLayers;

use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;

/**
 * Data Layer - IUserVoteDataLayer
 * @author Rodrigo Andrade
 */
interface IUserVoteDataLayer
{
    /**
     * @param VoteDTO $voteDTO
     */
    public function __invoke(VoteDTO $voteDTO): void;
}