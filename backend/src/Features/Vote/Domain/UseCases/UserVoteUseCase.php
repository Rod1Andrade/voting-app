<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Exception;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\UserVoteException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IUserVoteRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * UseCase - VoteUseCase
 * @author Rodrigo Andrade
 */
class UserVoteUseCase implements IUserVoteUseCase
{

    public function __construct(
        private IUserVoteRepository $repository
    )
    {
    }

    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void
    {
        try {
            $this->validate($votingUuid, $votingOptionUuid);

            ($this->repository)(new Vote($userUuid, $votingUuid, $votingOptionUuid));
        } catch (UserVoteException $e) {
            throw new UserVoteException($e->getMessage());
        } catch (Exception) {
            throw new UserVoteException('Unknown error');
        }
    }

    /**
     * @param VotingUuid $votingUuid
     * @param VotingOptionUuid $votingOptionUuid
     */
    private function validate(VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void
    {
        if(!Uuid::validate($votingUuid)) {
            throw new UserVoteException('Voting uuid is invalid');
        }

        if(!Uuid::validate($votingOptionUuid)) {
            throw new UserVoteException('Voting option uuid is invalid');
        }
    }
}
