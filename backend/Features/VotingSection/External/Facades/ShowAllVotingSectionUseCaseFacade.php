<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowAllVotingSectionsRepository;

/**
 * Class ShowAllVotingSectionUseCaseFacade
 * @package Rodri\VotingApp\Features\VotingSection\External\Facades
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionUseCaseFacade
{
    /**
     * @param Connection $connection
     * @param string $schema
     * @return IShowAllVotingSectionsUseCase
     */
    #[Pure] public function createUseCase(Connection $connection, string $schema = ''): IShowAllVotingSectionsUseCase
    {
        $dataLayer = new ShowAllVotingSectionsDataLayer($connection, $schema);
        $repository = new ShowAllVotingSectionsRepository($dataLayer);

        return new ShowAllVotingSectionsUseCase($repository);
    }
}