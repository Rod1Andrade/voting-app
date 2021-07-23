<?php


namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;


use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IRegisterUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use RuntimeException;

/**
 * Class RegisterUserUseCase
 * @package Rodri\VotingApp\Features\Auth\Domain\UseCases
 */
class RegisterUserUseCase implements IRegisterUserUseCase
{

    /**
     * RegisterUserUseCase constructor.
     * @param IRegisterUserRepository $repository
     */
    public function __construct(
        private IRegisterUserRepository $repository
    )
    {
    }

    /**
     * @param User $user
     * @throws RegisterUserException
     */
    public function __invoke(User $user): void
    {
        $this->validate($user);

        try {
            $this->repository->invoke($user);
        } catch (Exception) {
            throw new RegisterUserException('Impossible Register a user');
        }
    }

    /**
     * Validate user.
     * @param User $user
     * @throws RegisterUserException | RuntimeException
     */
    private function validate(User $user): void
    {
        try {
            $this->checkIfEmailAlreadyExist($user->getEmail());
        } catch (RegisterUserException | RuntimeException $e) {
            throw new RegisterUserException($e->getMessage());
        }
    }

    /**
     * Check if email already exist otherwise thrown a exception
     * @param Email $email
     * @throws RegisterUserException
     */
    private function checkIfEmailAlreadyExist(Email $email): void
    {
        if ($this->repository->hasEmailAlready($email))
            throw new RegisterUserException('Email already exist');
    }
}