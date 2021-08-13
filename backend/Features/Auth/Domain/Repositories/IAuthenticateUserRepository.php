<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Repositories;


use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use RuntimeException;

/**
 * Repository Interface - IAuthenticateUserRepository
 * @package Rodri\VotingApp\Features\Auth\Domain\Repositories
 * @author Rodrigo Andrade
 */
interface IAuthenticateUserRepository
{
    /**
     * Repository to intermediate a authenticate action with
     * data layer.
     * @param Email $email
     * @return User|null
     * @throws RuntimeException
     */
    public function __invoke(Email $email): ?User;
}
