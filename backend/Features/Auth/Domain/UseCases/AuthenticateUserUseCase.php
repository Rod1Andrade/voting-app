<?php


namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\AuthenticateUserException;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidCredentialsException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IAuthenticateUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;

/**
 * Class AuthenticateUserUseCase
 * @package Rodri\VotingApp\Features\Auth\Domain\UseCases
 * @author Rodrigo Andrade
 */
class AuthenticateUserUseCase implements IAuthenticateUserUseCase
{

    public function __construct(
        private IAuthenticateUserRepository $repository
    )
    {
    }

    public function __invoke(Email $email, Password $password): UserUuid
    {
        try {
            $user = ($this->repository)($email);

            if(empty($user)) {
                throw new InvalidCredentialsException('Invalid credentials!');
            }

            if (!PasswordEncrypt::check($user->getPassword(), $password))
                throw new InvalidCredentialsException('Email or password not match');

            return $user->getUserUuid();

        } catch (InvalidCredentialsException $e) {
            throw new AuthenticateUserException($e->getMessage());
        } catch (Exception) {
            throw new AuthenticateUserException('Its not possible authenticate a user.');
        }
    }
}
