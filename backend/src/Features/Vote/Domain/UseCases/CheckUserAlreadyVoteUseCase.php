<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Exception;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\CheckUserAlreadyVoteException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\ICheckUserAlreadyVoteRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Use case implementation - CheckUserAlreadyVoteUseCase
 * @author Rodrigo Andrade
 */
class CheckUserAlreadyVoteUseCase implements ICheckUserAlreadyVoteUseCase
{

    public function __construct(
        private ICheckUserAlreadyVoteRepository $repository
    )
    {
    }

    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid): bool
    {
        try {
            $this->validate($votingUuid);

            return ($this->repository)($userUuid, $votingUuid);
        } catch (CheckUserAlreadyVoteException $e) {
            throw new CheckUserAlreadyVoteException($e->getMessage());
        }
        catch (Exception){
            throw new CheckUserAlreadyVoteException('Its not possible check if user has voted.');
        }
    }

    /**
     * @param VotingUuid $votingUuid
     */
    private function validate(VotingUuid $votingUuid): void
    {
        if(!Uuid::validate($votingUuid->getValue()))
            throw new CheckUserAlreadyVoteException('Invalid voting uuid');
    }
}