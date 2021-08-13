<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IUpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\UpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\VotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\UpdateVotingOptionTitleDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\VotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\UpdateVotingOptionTitleRepository;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\VotingOptionCheckOwnerRepository;

/**
 * UpdateVotingOptionTitleUseCaseFacade
 *
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleUseCaseFacade
{
    /**
     * @param Connection $connection
     * @param string $schema
     * @return IUpdateVotingOptionTitleUseCase
     */
    public function createUseCase(Connection $connection, string $schema): IUpdateVotingOptionTitleUseCase
    {
        $checkOwnerDatalayer = new VotingOptionCheckOwnerDatalayer($connection, $schema);
        $checkOwnerRepository = new VotingOptionCheckOwnerRepository($checkOwnerDatalayer);
        $checkOwnerUseCase = new VotingOptionCheckOwnerUseCase($checkOwnerRepository);

        $dataLayer = new UpdateVotingOptionTitleDataLayer($connection, $schema);
        $repository = new UpdateVotingOptionTitleRepository($dataLayer);

        return new UpdateVotingOptionTitleUseCase($checkOwnerUseCase, $repository);
    }
}