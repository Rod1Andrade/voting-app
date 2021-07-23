<?php


namespace Rodri\VotingApp\Features\Auth\External\Adapters;


use Rodri\VotingApp\Features\Auth\Domain\Adapters\IPasswordEncrypt;

class PasswordEncrypt implements IPasswordEncrypt
{

    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function check(string $hashPassword, string $password): bool
    {
        return password_verify($password, $hashPassword);
    }
}