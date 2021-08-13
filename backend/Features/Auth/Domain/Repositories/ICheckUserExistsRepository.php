<?php

namespace Rodri\VotingApp\Features\Auth\Domain\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

/**
 * Repository - ICheckUserExistsRepository
 * @author Rodrigo Andrade
 */
interface ICheckUserExistsRepository
{
    /**
     * @param UserUuid $userUuid
     * @return bool
     */
    public function __invoke(UserUuid $userUuid): bool;
}
