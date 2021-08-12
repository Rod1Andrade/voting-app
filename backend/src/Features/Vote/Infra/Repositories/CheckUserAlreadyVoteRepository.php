<?php

namespace Rodri\VotingApp\Features\Vote\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\ICheckUserAlreadyVoteRepository;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\ICheckUserAlreadyVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\CheckUserAlreadyVoteRepositoryException;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Repository implementation - CheckUserAlreadyVoteRepository
 * @author Rodrigo Andrade
 */
class CheckUserAlreadyVoteRepository implements ICheckUserAlreadyVoteRepository
{

    public function __construct(
        private ICheckUserAlreadyVoteDataLayer $dataLayer
    )
    {
    }

    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid): bool
    {
        try {
            return ($this->dataLayer)($userUuid->getValue(), $votingUuid->getValue());
        } catch (Exception $e) {
            throw new CheckUserAlreadyVoteRepositoryException($e);
        }
    }
}
