<?php

namespace Rodri\VotingApp\Features\Auth\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\CheckUserExistsException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\ICheckUserExistsRepository;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

class CheckUserExistsUseCase implements ICheckUserExistsUseCase
{
    public function __construct(
        private ICheckUserExistsRepository $repository
    )
    {
    }

    public function __invoke(UserUuid $userUuid): bool
    {
        try {
            return ($this->repository)($userUuid);
        } catch (Exception) {
            throw new CheckUserExistsException('Impossible check if user exists');
        }
    }
}
