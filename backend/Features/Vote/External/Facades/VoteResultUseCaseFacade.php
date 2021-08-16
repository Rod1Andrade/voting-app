<?php

namespace Rodri\VotingApp\Features\Vote\External\Facades;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\VoteResultUseCase;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\IVoteResultUseCase;
use Rodri\VotingApp\Features\Vote\External\DataLayers\VoteResultDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\VoteResultRepository;

/**
 * Facade - VoteResultUseCaseFacade
 * @author Rodrigo Andrade
 */
class VoteResultUseCaseFacade
{
    /**
     * @param string $schema
     * @return IVoteResultUseCase
     */
    #[Pure] public function createUseCase(string $schema): IVoteResultUseCase
    {
        $dataLayer = new VoteResultDataLayer($schema);
        $repository = new VoteResultRepository($dataLayer);

        return new VoteResultUseCase($repository);
    }
}
