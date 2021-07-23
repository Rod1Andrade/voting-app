<?php


namespace Rodri\VotingApp\Features\Auth\Infra\Repositories;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IRegisterUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;

/**
 * Repository - RegisterUserRepository
 * @package Rodri\VotingApp\Features\Auth\Infra\Repositories
 * @author Rodrigo Andrade
 */
class RegisterUserRepository implements IRegisterUserRepository
{

    /**
     * RegisterUserRepository constructor.
     * @param IRegisterUserDataLayer $dataLayer
     */
    public function __construct(
        private IRegisterUserDataLayer $dataLayer
    )
    {
    }

    /**
     * @param User $user
     * @throws RegisterUserDataLayerException
     */
    public function invoke(User $user): void
    {
        try {
            $this->dataLayer->invoke(UserDTO::factoryUserDTO($user));
        } catch (Exception $e) {
            throw new RegisterUserDataLayerException('Impossible register a user');
        }
    }

    /**
     * @param Email $email
     * @return bool
     * @throws RegisterUserDataLayerException
     */
    public function hasEmailAlready(Email $email): bool
    {
        try {
            return $this->dataLayer->hasEmailAlready($email);
        } catch (Exception $e) {
            throw new RegisterUserDataLayerException('Impossible check if email already exist.');
        }
    }
}