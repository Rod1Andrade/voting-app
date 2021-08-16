<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataLayers;

use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;

/**
 * Data layer - IVoteResultDataLayer
 * @author Rodrigo Andrade
 */
interface IVoteResultDataLayer
{
    /**
     * Get a result from a voting section.
     *
     * @param string $votingUuid
     * @return VoteDTO|null
     */
    public function __invoke(string $votingUuid): ?VoteDTO;
}
