<?php

namespace Rodri\VotingApp\Features\Auth\External\Facades;

use Rodri\VotingApp\Features\Auth\Domain\UseCases\CheckUserExistsUseCase;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\ICheckUserExistsUseCase;
use Rodri\VotingApp\Features\Auth\External\DataLayer\CheckUserExistsDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\CheckUserExistsRepository;

class CheckUserExistsUseCaseFacade
{
    /**
     * @return ICheckUserExistsUseCase
     */
    public function createUseCase(): ICheckUserExistsUseCase
    {
        $datalayer = new CheckUserExistsDataLayer();
        $repository = new CheckUserExistsRepository($datalayer);

        return new CheckUserExistsUseCase($repository);
    }
}
