<?php


namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\Entities\User;

/**
 * Use Case Interface - IRegisterUserUseCase
 * @package Rodri\VotingApp\Features\Auth\Domain\UseCases
 * @author Rodrigo Andrade
 */
interface IRegisterUserUseCase
{
    /**
     * Register a user.
     * @param User $user - User to be registered.
     */
    public function __invoke(User $user): void;
}