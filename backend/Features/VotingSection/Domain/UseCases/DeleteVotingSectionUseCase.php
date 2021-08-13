<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Delete Voting Section Implementation
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
class DeleteVotingSectionUseCase implements IDeleteVotingSectionUseCase
{

    public function __construct(
        private IDeleteVotingSectionRepository $repository
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid, UserUuid $userUuid): void
    {
        try {
            $this->validate($votingUuid);

            ($this->repository)($votingUuid, $userUuid);
        } catch (DeleteVotingSectionException $e) {
            throw  new DeleteVotingSectionException($e->getMessage());
        } catch (Exception) {
            throw  new DeleteVotingSectionException('Unknown error');
        }
    }

    /**
     * @param VotingUuid $votingUUid
     */
    private function validate(VotingUUid $votingUUid)
    {
        if (empty($votingUUid) || empty($votingUUid->getValue())) {
            throw new DeleteVotingSectionException('The voting uuid its necessary.');
        }

        if (!Uuid::validate($votingUUid->getValue())) {
            throw new DeleteVotingSectionException('Invalid UUID format.');
        }
    }

}