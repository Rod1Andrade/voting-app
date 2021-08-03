<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingOptionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingOptionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Use case implementation - DeleteVotingOptionUseCase
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionUseCase implements IDeleteVotingOptionUseCase
{

    public function __construct(
        private IDeleteVotingOptionRepository $repository
    )
    {
    }

    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void
    {
        try {
            ($this->repository)($votingOptionUuid, $userUuid);
        } catch (Exception $e) {
            throw new DeleteVotingOptionException($e);
        }
    }
}