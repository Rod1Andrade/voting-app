<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\VotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\UpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IUpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\VotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\VotingOptionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\UpdateVotingOptionTitleDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\UpdateVotingOptionTitleRepository;

/**
 * UpdateVotingOptionTitleUseCaseFacade
 *
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleUseCaseFacade
{
    /**
     * @param string $schema
     * @return IUpdateVotingOptionTitleUseCase
     */
    public function createUseCase(string $schema): IUpdateVotingOptionTitleUseCase
    {
        $checkOwnerDatalayer = new VotingOptionCheckOwnerDatalayer($schema);
        $checkOwnerRepository = new VotingOptionCheckOwnerRepository($checkOwnerDatalayer);
        $checkOwnerUseCase = new VotingOptionCheckOwnerUseCase($checkOwnerRepository);

        $dataLayer = new UpdateVotingOptionTitleDataLayer($schema);
        $repository = new UpdateVotingOptionTitleRepository($dataLayer);

        return new UpdateVotingOptionTitleUseCase($checkOwnerUseCase, $repository);
    }
}
