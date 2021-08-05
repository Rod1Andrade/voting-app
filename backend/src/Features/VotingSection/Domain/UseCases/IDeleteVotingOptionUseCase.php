<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Use Case - IDeleteVotingOptionUseCase
 * @author Rodrigo Andrade
 */
interface IDeleteVotingOptionUseCase
{

    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     */
    public function __invoke(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void;

}