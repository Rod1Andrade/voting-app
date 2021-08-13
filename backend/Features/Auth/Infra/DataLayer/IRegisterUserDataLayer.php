<?php


namespace Rodri\VotingApp\Features\Auth\Infra\DataLayer;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;

/**
 * Data Layer - Interface IRegisterUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\Infra\DataLayer
 * @author Rodrigo Andrade
 */
interface IRegisterUserDataLayer
{
    /**
     * @param UserDTO $userDTO
     * @throws Exception
     */
    public function invoke(UserDTO $userDTO): void;

    /**
     * @param Email $email
     * @return bool
     * @throws Exception
     */
    public function hasEmailAlready(Email $email): bool;

}