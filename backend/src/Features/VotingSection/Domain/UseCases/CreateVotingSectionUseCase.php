<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use DateTime;
use InvalidArgumentException;
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
            throw new CreateVotingSectionException('The user UUID needs be defined');
        }

        if (empty($voting->getVotingUuid())) {
            throw new CreateVotingSectionException('The Voting UUID needs be defined');
        }

        if (empty($voting->getSubject())) {
            throw new CreateVotingSectionException('The Voting Subject needs be defined');
        }

        if (empty($voting->getStartDate())) {
            throw new CreateVotingSectionException('The Voting start date needs be defined');
        }

        if ($voting->getStartDate() < new DateTime('today'))
            throw new InvalidArgumentException('The date needs be today forward.');

        if ($voting->getFinishDate() <= $voting->getStartDate())
            throw new InvalidArgumentException('The date needs be bigger than finish date.');

        if ($voting->getFinishDate()->diff($voting->getStartDate())->days === 0
            && $voting->getFinishDate()->diff($voting->getStartDate())->h < 1)
            throw new InvalidArgumentException('The created date needs be bigger than finish date at least 1 hour.');

        if (empty($voting->getFinishDate())) {
            throw new CreateVotingSectionException('The Voting finish date needs be defined');
        }
    }
}
