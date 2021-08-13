<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Repositories;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;

/**
 * Repository Interface - IRegisterUserRepository
 * @package Rodri\VotingApp\Features\Auth\Domain\Repositories
 * @author Rodrigo Andrade
 */
interface IRegisterUserRepository
{
    /**
     * Repository to intermediate a register action with
     * data layer.
     * @param User $user
     * @throws Exception
     */
    public function invoke(User $user): void;

    /**
     * Check if email already exist. Normally used to prevent duplicated
     * emails.
     * @param Email $email
     * @return bool True if already exist and False otherwise.
     */
    public function hasEmailAlready(Email $email): bool;
}