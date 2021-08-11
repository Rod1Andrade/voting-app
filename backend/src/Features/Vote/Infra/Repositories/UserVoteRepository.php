<?php

namespace Rodri\VotingApp\Features\Vote\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IUserVoteRepository;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\UserVoteRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

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

    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void
    {
        try {
            ($this->dataLayer)($userUuid, $votingUuid, $votingOptionUuid);
        } catch (Exception $e) {
            throw new UserVoteRepositoryException($e);
        }
    }
}