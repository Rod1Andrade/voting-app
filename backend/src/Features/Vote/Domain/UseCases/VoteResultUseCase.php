<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\VoteResultException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IVoteResultRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Use case implementation - VoteResultUseCase
 * @author Rodrigo Andrade
 */
class VoteResultUseCase implements IVoteResultUseCase
{
    public function __construct(
        private IVoteResultRepository $repository
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): Vote
    {
        try {
            return ($this->repository)($votingUuid);
        } catch (Exception) {
            throw new VoteResultException('Unknown error');
        }
    }
}