<?php

namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

/**
 * Use Case - ICheckUserExistsUseCase
 * @author Rodrigo Andrade
 */
interface ICheckUserExistsUseCase
{
    /**
     * Check if the user passed by argument exists
     * @param UserUuid $userUuid
     * @return bool
     */
    public function __invoke(UserUuid $userUuid): bool;
}
