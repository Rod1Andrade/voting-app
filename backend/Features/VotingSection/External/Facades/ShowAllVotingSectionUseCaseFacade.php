<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowAllVotingSectionsRepository;

/**
 * Class ShowAllVotingSectionUseCaseFacade
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionUseCaseFacade
{
    /**
     * @param string $schema
     * @return IShowAllVotingSectionsUseCase
     */
    #[Pure] public function createUseCase(string $schema = ''): IShowAllVotingSectionsUseCase
    {
        $dataLayer = new ShowAllVotingSectionsDataLayer($schema);
        $repository = new ShowAllVotingSectionsRepository($dataLayer);

        return new ShowAllVotingSectionsUseCase($repository);
    }
}
