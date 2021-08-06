<?php

namespace Rodri\VotingApp\Features\Vote\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * UseCase - IVoteUseCase
 * @author Rodrigo Andrade
 */
interface IUserVoteUseCase
{
    /**
     * @param UserUuid $userUuid
     * @param VotingUuid $votingUuid
     * @param VotingOptionUuid $votingOptionUuid
     */
    public function __invoke(UserUuid $userUuid, VotingUuid $votingUuid, VotingOptionUuid $votingOptionUuid): void;

}