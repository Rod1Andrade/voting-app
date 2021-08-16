<?php

namespace Rodri\VotingApp\Features\Vote\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IVoteResultRepository;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IVoteResultDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\VoteResultRepositoryException;

class VoteResultRepository implements IVoteResultRepository
{

    public function __construct(
        private IVoteResultDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): Vote
    {
        try {
            return VoteDTO::createVoteFromVoteDTO(($this->dataLayer)($votingUuid->getValue()));
        } catch (Exception $e) {
            throw new VoteResultRepositoryException($e);
        }
    }
}
