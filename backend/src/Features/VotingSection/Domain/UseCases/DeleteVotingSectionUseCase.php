<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
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
            if (empty($votingUuid) || empty($votingUuid->getValue())) {
                throw new DeleteVotingSectionException('The voting uuid its necessary.');
            }

            ($this->repository)($votingUuid, $userUuid);

        } catch (Exception $e) {
            throw  new DeleteVotingSectionException($e);
        }
    }
}