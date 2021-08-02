<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\DeleteVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\DeleteVotingSectionRepository;

class DeleteVotingSectionUseCaseFacade
{
    public function createUseCase(Connection $connection, string $schema = ''): IDeleteVotingSectionUseCase
    {
        $dataLayer = new DeleteVotingSectionDataLayer($connection, $schema);
        $repository = new DeleteVotingSectionRepository($dataLayer);
        return new DeleteVotingSectionUseCase($repository);
    }
}