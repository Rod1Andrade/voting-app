<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\VotingOptionCheckOwnerException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IVotingOptionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Repository Implementation - VotingOptionCheckOwnerUseCase
 * @author Rodrigo Andrade
 */
class VotingOptionCheckOwnerUseCase implements IVotingOptionCheckOwnerUseCase
{

    public function __construct(
        private IVotingOptionCheckOwnerRepository $repository
    )
    {
    }

    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): bool
    {
        try {
            return ($this->repository)($votingOptionUuid, $userUuid);
        } catch (Exception) {
            throw new VotingOptionCheckOwnerException('Its not possible check if you are the owner.');
        }
    }
}