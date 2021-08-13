<?php


namespace Rodri\VotingApp\Features\Auth\Infra\Repositories;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IAuthenticateUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IAuthenticateUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\AuthenticateUserDataLayerException;

/**
 * Class AuthenticateUserRepository
 * @package Rodri\VotingApp\Features\Auth\Infra\Repositories
 * @author Rodrigo Andrade
 */
class AuthenticateUserRepository implements IAuthenticateUserRepository
{
    public function __construct(
        private IAuthenticateUserDataLayer $dataLayer
    )
    {
    }

    public function __invoke(Email $email): ?User
    {
        try {
            return UserDTO::FactoryUserFromDTO(($this->dataLayer)($email));
        } catch (Exception $e) {
            throw new AuthenticateUserDataLayerException($e);
        }
    }
}
