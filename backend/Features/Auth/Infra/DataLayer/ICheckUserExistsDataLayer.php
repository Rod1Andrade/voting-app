<?php

namespace Rodri\VotingApp\Features\Auth\Infra\DataLayer;

/**
 * DataLayer - ICheckUserExistsDataLayer
 * @author Rodrigo Andrade
 */
interface ICheckUserExistsDataLayer
{
    /**
     * @param string $userUuid
     * @return bool
     */
    public function __invoke(string $userUuid): bool;
}
