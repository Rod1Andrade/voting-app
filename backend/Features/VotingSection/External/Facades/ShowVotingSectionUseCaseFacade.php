<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowVotingSectionRepository;

class ShowVotingSectionUseCaseFacade
{
    #[Pure] public function createUseCase(string $schema = ''): IShowVotingSectionUseCase
    {
        $dataLayer = new ShowVotingSectionDataLayer($schema);
        $repository = new ShowVotingSectionRepository($dataLayer);

        return new ShowVotingSectionUseCase($repository);
    }
}
