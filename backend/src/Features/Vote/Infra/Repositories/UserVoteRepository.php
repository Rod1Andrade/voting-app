<?php

namespace Rodri\VotingApp\Features\Vote\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IUserVoteRepository;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\UserVoteRepositoryException;

/**
 * Repository - UserVoteRepository
 * @author Rodrigo Andrade
 */
class UserVoteRepository implements IUserVoteRepository
{

    public function __construct(
        private IUserVoteDataLayer $dataLayer
    )
    {
    }

    public function __invoke(Vote $vote): void
    {
        try {
            ($this->dataLayer)(VoteDTO::createVoteDTOFromVote($vote));
        } catch (Exception $e) {
            throw new UserVoteRepositoryException($e);
        }
    }
}