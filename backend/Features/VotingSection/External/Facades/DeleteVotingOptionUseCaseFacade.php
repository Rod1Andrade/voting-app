<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\VotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\DeleteVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\VotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\DeleteVotingOptionRepository;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\VotingOptionCheckOwnerRepository;

/**
 * Facade - DeleteVotingOptionUseCaseFacade
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionUseCaseFacade
{
    /**
     * @param Connection $connection
     * @param string $schema
     * @return IDeleteVotingOptionUseCase
     */
    public function createUseCase(Connection $connection, string $schema): IDeleteVotingOptionUseCase
    {
        $checkOwnerDatalayer = new VotingOptionCheckOwnerDatalayer($connection, $schema);
        $checkOwnerRepository = new VotingOptionCheckOwnerRepository($checkOwnerDatalayer);
        $checkOwnerUseCase = new VotingOptionCheckOwnerUseCase($checkOwnerRepository);

        $deleteVotingOptionDataLayer = new DeleteVotingOptionDataLayer($connection, $schema);
        $deleteVotingOptionRepository = new DeleteVotingOptionRepository($deleteVotingOptionDataLayer);

        return new DeleteVotingOptionUseCase($checkOwnerUseCase, $deleteVotingOptionRepository);
    }
}