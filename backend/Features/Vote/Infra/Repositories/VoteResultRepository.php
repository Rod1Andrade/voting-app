<?php

namespace Rodri\VotingApp\Features\Vote\Infra\Repositories;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IVoteResultRepository;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IVoteResultDataLayer;

class VoteResultRepository implements IVoteResultRepository
{

    public function __construct(
        private IVoteResultDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): Vote
    {
        return ($this->dataLayer)($votingUuid->getValue());
    }
}
