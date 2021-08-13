<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\VotingSectionCheckOwnerException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IVotingSectionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Use case implementation - VotingSectionCheckOwnerUseCase
 * @author Rodrigo Andrade
 */
class VotingSectionCheckOwnerUseCase implements IVotingSectionCheckOwnerUseCase
{

    public function __construct(
        private IVotingSectionCheckOwnerRepository $repository
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): bool
    {
        try {
            return ($this->repository)($votingUuid, $userUuid);
        } catch (Exception) {
            throw new VotingSectionCheckOwnerException('Its not possible check if you are the owner.');
        }
    }
}
