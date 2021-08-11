<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Exception;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
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
        private ICheckUserAlreadyVoteUseCase $alreadyVoteUseCase,
        private IUserVoteRepository $repository
    )
    {
    }

    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void
    {
        try {
            $this->validate($userUuid, $votingUuid, $votingOptionUuid);

            ($this->repository)($userUuid, $votingUuid, $votingOptionUuid);
        } catch (UserVoteException $e) {
            throw new UserVoteException($e->getMessage());
        } catch (Exception) {
            throw new UserVoteException('Unknown error');
        }
    }

    /**
     * @param UserUuid $userUuid
     * @param VotingUuid $votingUuid
     * @param VotingOptionUuid $votingOptionUuid
     */
    private function validate(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void
    {
        if(!Uuid::validate($votingUuid)) {
            throw new UserVoteException('Voting uuid is invalid');
        }

        if(!Uuid::validate($votingOptionUuid)) {
            throw new UserVoteException('Voting option uuid is invalid');
        }

        if(($this->alreadyVoteUseCase)($userUuid, $votingUuid)) {
            throw new UserVoteException('Not allowed, because do you already vote in this voting section. Thank you.');
        }
    }
}
