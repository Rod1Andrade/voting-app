<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Adapters;

/**
 * Interface IPasswordEncrypt
 * @package Rodri\VotingApp\Features\Auth\Domain\Adapters
 */
interface IPasswordEncrypt
{
    /**
     * Hash the password and return it
     * @param string $password
     * @return string
     */
    public function hash(string $password): string;

    /**
     * Check if the password is equals
     * @param string $basePassword
     * @param string $password
     * @return bool
     */
    public function check(string $basePassword, string $password): bool;
}