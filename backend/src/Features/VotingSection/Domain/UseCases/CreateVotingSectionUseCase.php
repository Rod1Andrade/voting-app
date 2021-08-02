<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\CreateVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\ICreateVotingSectionRepository;
use RuntimeException;

/**
 * Use Case CreatedVotingSection
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
class CreateVotingSectionUseCase implements ICreateVotingSectionUseCase
{

    public function __construct(
        private ICreateVotingSectionRepository $repository
    )
    {
    }

    public function __invoke(Voting $voting): void
    {
        try {
            $this->validate($voting);
            ($this->repository)($voting);
        } catch (RuntimeException $e) {
            throw new CreateVotingSectionException($e);
        }
    }

    /**
     * Validate required values for create a voting section
     * @param Voting $voting
     * @throws CreateVotingSectionException
     */
    private function validate(Voting $voting): void
    {
        if(empty($voting->getUserUuid())) {
            throw new CreateVotingSectionException('The user UUID needs ben defined');
        }

        if (empty($voting->getVotingUuid())) {
            throw new CreateVotingSectionException('The Voting UUID needs ben defined');
        }

        if (empty($voting->getSubject())) {
            throw new CreateVotingSectionException('The Voting Subject needs ben defined');
        }

        if (empty($voting->getStartDate())) {
            throw new CreateVotingSectionException('The Voting start date needs ben defined');
        }

        if (empty($voting->getFinishDate())) {
            throw new CreateVotingSectionException('The Voting finsish date needs ben defined');
        }
    }
}
