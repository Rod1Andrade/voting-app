<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowVotingSectionRepository;

class ShowVotingSectionUseCaseFacade
{
    public function createUseCase(Connection $connection, string $schema = ''): IShowVotingSectionUseCase
    {
        $dataLayer = new ShowVotingSectionDataLayer($connection);
        $repository = new ShowVotingSectionRepository($dataLayer);

        return new ShowVotingSectionUseCase($repository);
    }
}