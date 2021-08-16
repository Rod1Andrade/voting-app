<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Exception;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IVoteResultRepository;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\VoteResultException;

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

    public function __invoke(VotingUuid $votingUuid): ?Vote
    {
        try {
            $this->validate($votingUuid);
            return ($this->repository)($votingUuid);
        } catch (VoteResultException $e) {
            throw new VoteResultException($e->getMessage());
        }
        catch (Exception) {
            throw new VoteResultException('Unknown error');
        }
    }

    /**
     * @param VotingUuid $votingUuid
     */
    private function validate(VotingUuid $votingUuid): void
    {
        if(!Uuid::validate($votingUuid->getValue())) {
            throw new VoteResultException('Uuid needs be valid');
        }
    }
}
