<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IVotingSectionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingSectionCheckOwnerDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\VotingSectionCheckOwnerRepositoryException;

/**
 * Repository Implementation - VotingSectionCheckOwnerRepository
 * @author Rodrigo Andrade
 */
class VotingSectionCheckOwnerRepository implements IVotingSectionCheckOwnerRepository
{

    public function __construct(
        private IVotingSectionCheckOwnerDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): bool
    {
        try {
            return ($this->dataLayer)($votingUuid->getValue(), $userUuid->getValue());
        } catch (Exception $e) {
            throw new VotingSectionCheckOwnerRepositoryException($e);
        }
    }
}
