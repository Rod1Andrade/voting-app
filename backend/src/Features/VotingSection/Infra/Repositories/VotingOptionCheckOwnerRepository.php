<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IVotingOptionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\VotingOptionCheckOwnerRepositoryException;

/**
 * Repository - VotingOptionCheckOwnerRepository
 * @author Rodrigo Andrade
 */
class VotingOptionCheckOwnerRepository implements IVotingOptionCheckOwnerRepository
{

    public function __construct(
        private IVotingOptionCheckOwnerDatalayer $datalayer,
    )
    {
    }

    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): bool
    {
        try {
            return ($this->datalayer)($votingOptionUuid, $userUuid);
        } catch (Exception $e) {
            throw new VotingOptionCheckOwnerRepositoryException($e);
        }
    }
}