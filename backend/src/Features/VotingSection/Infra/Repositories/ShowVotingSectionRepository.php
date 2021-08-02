<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class ShowVotingSectionRepository implements IShowVotingSectionRepository
{

    public function __invoke(VotingUuid $votingUuid): Voting
    {
    }
}