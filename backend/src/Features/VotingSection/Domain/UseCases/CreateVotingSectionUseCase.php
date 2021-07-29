<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\CreateVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\ICreatedVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use RuntimeException;

/**
 * Use Case CreatedVotingSection
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
class CreateVotingSectionUseCase implements ICreateVotingSectionUseCase
{

    public function __construct(
        private ICreatedVotingSectionRepository $repository
    )
    {
    }

    public function __invoke(Voting $voting): void
    {
        try{
            ($this->repository)($voting);
        } catch (RuntimeException $e) {
            throw new CreateVotingSectionException($e);
        }
    }
}