<?php


namespace Rodri\VotingApp\Features\Auth\External\Adapters;

use Ramsey\Uuid\Uuid as RUuid;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;

/**
 * Class Uuid
 * @package Rodri\VotingApp\Features\Auth\External\Adapters
 * @author Rodrigo Andrade
 */
class Uuid implements IUuid
{

    public function genUUIDv4(): string
    {
        return RUuid::uuid4()->toString();
    }
}