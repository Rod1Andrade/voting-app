<?php


namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;


use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

/**
 * Interface IAuthenticateUserUseCase
 * @package Rodri\VotingApp\Features\Auth\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface IAuthenticateUserUseCase
{
    /**
     * Authenticate a user with email and password.
     * @param Email $email
     * @param Password $password
     */
    public function __invoke(Email $email, Password $password): UserUuid;
}