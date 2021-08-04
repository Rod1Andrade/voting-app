<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\ShowVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class ShowVotingSectionUseCase implements IShowVotingSectionUseCase
{

    public function __construct(
        private IShowVotingSectionRepository $repository
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): ?Voting
    {
        try {
            return ($this->repository)($votingUuid);
        } catch (Exception) {
            throw new ShowVotingSectionException('It\'s not possible to return a voting section: Check uuid');
        }
    }
}