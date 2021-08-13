<?php

namespace Rodri\VotingApp\Features\VotingSection\External\Facades;

use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\VotingSectionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\DeleteVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\VotingSectionCheckOwnerDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\DeleteVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\VotingSectionCheckOwnerRepository;

/**
 * Class DeleteVotingSectionUseCaseFacade
 * @package Rodri\VotingApp\Features\VotingSection\External\Facades
 * @author Rodrigo Andrade
 */
class DeleteVotingSectionUseCaseFacade
{
    public function createUseCase(string $schema = ''): IDeleteVotingSectionUseCase
    {
        $votingSectionCheckOwnerDataLayer = new VotingSectionCheckOwnerDataLayer($schema);
        $votingSectionCheckOwnerRepository = new VotingSectionCheckOwnerRepository($votingSectionCheckOwnerDataLayer);
        $votingSectionCheckOwnerUseCase = new VotingSectionCheckOwnerUseCase($votingSectionCheckOwnerRepository);

        $dataLayer = new DeleteVotingSectionDataLayer($schema);
        $repository = new DeleteVotingSectionRepository($dataLayer);

        return new DeleteVotingSectionUseCase($votingSectionCheckOwnerUseCase, $repository);
    }
}
