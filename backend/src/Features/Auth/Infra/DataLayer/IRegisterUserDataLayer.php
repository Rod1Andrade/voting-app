<?php


namespace Rodri\VotingApp\Features\Auth\Infra\DataLayer;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;

/**
 * Data Layer - Interface IRegisterUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\Infra\DataLayer
 * @author Rodrigo Andrade
 */
interface IRegisterUserDataLayer
{
    /**
     * @param User $user
     * @throws Exception
     */
    public function invoke(User $user): void;

    /**
     * @param Email $email
     * @return bool
     * @throws Exception
     */
    public function hasEmailAlready(Email $email): bool;

}