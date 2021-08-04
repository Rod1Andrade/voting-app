<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use InvalidArgumentException;
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
        private IVotingOptionCheckOwnerUseCase $checkOwnerUseCase,
        private IDeleteVotingOptionRepository  $repository,
    )
    {
    }

    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void
    {
        try {
            if (($this->checkOwnerUseCase)($votingOptionUuid, $userUuid))
                ($this->repository)($votingOptionUuid, $userUuid);
            else
                throw new InvalidArgumentException('To delete a voting option you need be the owner.');
        } catch (InvalidArgumentException $e) {
            throw new DeleteVotingOptionException($e->getMessage());
        } catch (Exception $e) {
            throw new DeleteVotingOptionException($e);
        }
    }
}