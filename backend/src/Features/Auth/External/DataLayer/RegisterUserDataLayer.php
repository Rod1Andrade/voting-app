<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;

//TODO: think about it: Inject Connection or just use???
//TODO: test register user data layer without real database.

use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;

/**
 * Data Layer - RegisterUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\External\DataLayer
 * @author Rodrigo Andrade
 */
class RegisterUserDataLayer implements IRegisterUserDataLayer
{


    /**
     * @param User $user
     */
    public function invoke(User $user): void
    {
        $sql = "";
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function hasEmailAlready(Email $email): bool
    {
        $sql = "";
    }
}