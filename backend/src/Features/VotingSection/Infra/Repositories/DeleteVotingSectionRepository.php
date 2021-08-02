<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\DeleteVotingSectionRepositoryException;

/**
 * Class DeleteVotingSectionRepository
 * @package Rodri\VotingApp\Features\VotingSection\Infra\Repositories
 * @author Rodrigo Andrade
 */
class DeleteVotingSectionRepository implements IDeleteVotingSectionRepository
{

    public function __construct(
        private IDeleteVotingSectionDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): void
    {
        try {
            ($this->dataLayer)($votingUuid);
        }catch (Exception $e) {
            throw new DeleteVotingSectionRepositoryException($e);
        }
    }
}