<?php

namespace Rodri\VotingApp\Features\Auth\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\ICheckUserExistsRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\ICheckUserExistsDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\CheckUserExistsRepositoryException;

/**
 * Repository - CheckUserExistsRepository
 * @author Rodrigo Andrade
 */
class CheckUserExistsRepository implements ICheckUserExistsRepository
{

    public function __construct(
        private ICheckUserExistsDataLayer $datalayer
    )
    {
    }

    public function __invoke(UserUuid $userUuid): bool
    {
        try {
            return ($this->datalayer)($userUuid);
        } catch (Exception $e) {
            throw new CheckUserExistsRepositoryException($e);
        }
    }
}
