<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Adapters;

/**
 * Interface IUuid
 * @package Rodri\VotingApp\Features\Auth\Domain\Adapters
 */
interface IUuid
{
    /**
     * Generate a uuid and return it like a string.
     * @return string
     */
    public static function  genUUIDv4(): string;

    /**
     * Validate a UUID
     * @param string $uuid
     * @return bool
     */
    public static function validate(string $uuid): bool;
}