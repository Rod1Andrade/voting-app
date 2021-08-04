<?php


namespace Rodri\VotingApp\App\Adapters;

use Ramsey\Uuid\Uuid as RUuid;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;

/**
 * Class Uuid
 * @package Rodri\VotingApp\Features\Auth\External\Adapters
 * @author Rodrigo Andrade
 */
class Uuid implements IUuid
{

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public static function genUUIDv4(): string
    {
        return RUuid::uuid4()->toString();
    }

    /**
     * @param string $uuid
     * @return bool
     * @codeCoverageIgnore
     */
    public static function validate(string $uuid): bool
    {
        return RUuid::isValid($uuid);
    }
}