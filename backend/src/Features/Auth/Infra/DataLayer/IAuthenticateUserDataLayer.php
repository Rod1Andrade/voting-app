<?php


namespace Rodri\VotingApp\Features\Auth\Infra\DataLayer;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;

/**
 * Interface IAuthenticateUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\Infra\DataLayer
 * @author Rodrigo Andrade
 */
interface IAuthenticateUserDataLayer
{
    /**
     * Get a user by your email to authenticate it.
     * @param Email $email
     * @return UserDTO
     * @throws Exception
     */
    public function __invoke(Email $email): UserDTO;
}