<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Facades;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\CreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\CreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\CreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\CreateVotingSectionRepository;

/**
 * Class CreateVotingSectionUseCaseFacade
 * @package Rodri\VotingApp\Features\VotingSection\External\Facades
 * @author Rodrigo Andrade
 */
class CreateVotingSectionUseCaseFacade
{

    /**
     * @param string $schema
     * @return ICreateVotingSectionUseCase
     */
    #[Pure] public function createUseCase(string $schema = ''): ICreateVotingSectionUseCase
    {
        $votingOptionDataLayer = new CreateVotingOptionDataLayer($schema);
        $dataLayer = new CreateVotingSectionDataLayer($votingOptionDataLayer, $schema);
        $repository = new CreateVotingSectionRepository($dataLayer);

        return new CreateVotingSectionUseCase($repository);
    }

}
