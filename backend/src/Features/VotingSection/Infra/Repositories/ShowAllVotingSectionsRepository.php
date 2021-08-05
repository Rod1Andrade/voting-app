<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowAllVotingSectionsRepository;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\ShowAllVotingSectionRepositoryException;

class ShowAllVotingSectionsRepository implements IShowAllVotingSectionsRepository
{

    public function __construct(
        private IShowAllVotingSectionsDataLayer $dataLayer
    )
    {
    }

    public function __invoke(int $offset, int $limit): array
    {
        try {
            return ($this->dataLayer)($offset, $limit);
        } catch (Exception $e) {
            throw new ShowAllVotingSectionRepositoryException($e);
        }
    }
}