<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingOptionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\DeleteVotingOptionRepositoryException;

/**
 * Repository - DeleteVotingOptionRepository
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionRepository implements IDeleteVotingOptionRepository
{

    public function __construct(
        private IDeleteVotingOptionDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingOptionUuid $votingOptionUuid): void
    {
        try {
            ($this->dataLayer)($votingOptionUuid);
        } catch (Exception $e) {
            throw new DeleteVotingOptionRepositoryException($e);
        }
    }
}
