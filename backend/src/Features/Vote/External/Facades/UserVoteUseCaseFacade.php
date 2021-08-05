<?php

namespace Rodri\VotingApp\Features\Vote\External\Facades;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\IUserVoteUseCase;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\UserVoteUseCase;
use Rodri\VotingApp\Features\Vote\External\DataLayers\UserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\UserVoteRepository;

/**
 * Facade - UserVoteUseCaseFacade
 * @author Rodrigo Andrade
 */
class UserVoteUseCaseFacade
{
    /**
     * @param Connection $connection
     * @param string $schema
     * @return IUserVoteUseCase
     */
    public function createUseCase(Connection $connection, string $schema): IUserVoteUseCase
    {
        $dataLayer = new UserVoteDataLayer($connection, $schema);
        $repository = new UserVoteRepository($dataLayer);

        return new UserVoteUseCase($repository);
    }
}