<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataLayers;

use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;

interface IVoteResultDataLayer
{
    /**
     * Get a result from a voting section.
     *
     * @param string $votingUuid
     * @return VoteDTO
     */
    public function __invoke(string $votingUuid): VoteDTO;
}
