<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use InvalidArgumentException;
use Rodri\VotingApp\App\Adapters\Uuid;
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
            $this->validate($votingOptionUuid, $userUuid);

            ($this->repository)($votingOptionUuid, $userUuid);

        } catch (InvalidArgumentException | DeleteVotingOptionException $e) {
            throw new DeleteVotingOptionException($e->getMessage());
        } catch (Exception) {
            throw new DeleteVotingOptionException('Unknown error');
        }
    }

    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     */
    private function validate(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void
    {
        if (!Uuid::validate($votingOptionUuid->getValue())) {
            throw new DeleteVotingOptionException('Invalid UUID.');
        }

        if (!($this->checkOwnerUseCase)($votingOptionUuid, $userUuid)) {
            throw new InvalidArgumentException('To delete a voting option you need be the owner.');
        }
    }
}