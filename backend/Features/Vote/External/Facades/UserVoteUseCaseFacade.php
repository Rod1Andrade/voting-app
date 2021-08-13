<?php

namespace Rodri\VotingApp\Features\Vote\External\Facades;

use Rodri\VotingApp\Features\Vote\Domain\UseCases\UserVoteUseCase;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\IUserVoteUseCase;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\UserVoteRepository;
use Rodri\VotingApp\Features\Vote\External\DataLayers\UserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\CheckUserAlreadyVoteUseCase;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\CheckUserAlreadyVoteRepository;
use Rodri\VotingApp\Features\Vote\External\DataLayers\CheckUserAlreadyVoteDataLayer;

/**
 * Facade - UserVoteUseCaseFacade
 * @author Rodrigo Andrade
 */
class UserVoteUseCaseFacade
{
    /**
     * @param string $schema
     * @return IUserVoteUseCase
     */
    public function createUseCase(string $schema): IUserVoteUseCase
    {
        $checkAlreadyVoteDataLayer = new CheckUserAlreadyVoteDataLayer($schema);
        $checkAlreadyVoteRepository = new CheckUserAlreadyVoteRepository($checkAlreadyVoteDataLayer);
        $checkAlreadyVoteUseCase = new CheckUserAlreadyVoteUseCase($checkAlreadyVoteRepository);

        $dataLayer = new UserVoteDataLayer($schema);
        $repository = new UserVoteRepository($dataLayer);

        return new UserVoteUseCase($checkAlreadyVoteUseCase, $repository);
    }
}
