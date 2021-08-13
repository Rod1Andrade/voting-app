<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Adapters;

/**
 * Interface IPasswordEncrypt
 * @package Rodri\VotingApp\Features\Auth\Domain\Adapters
 */
interface IPasswordEncrypt
{

    public const DEFAULT_HASH = PASSWORD_BCRYPT;

    /**
     * Hash the password and return it
     * @param string $password
     * @return string
     */
    public static function hash(string $password): string;

    /**
     * Check if the password is equals
     * @param string $hashPassword
     * @param string $password
     * @return bool
     */
    public static function check(string $hashPassword, string $password): bool;

    /**
     * Check if the password has any encrypt
     * @param string $password
     * @return bool
     */
    public static function isNotEncrypt(string $password): bool;
}