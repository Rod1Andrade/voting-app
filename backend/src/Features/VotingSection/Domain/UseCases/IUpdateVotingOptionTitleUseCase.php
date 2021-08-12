<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Use Case - IUpdateVotingOptionTitle
 * @author Rodrigo Andrade
 */
interface IUpdateVotingOptionTitleUseCase
{
    /**
     * Update the voting option title.
     *
     * @param Title $title
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     */
    public function __invoke(Title $title, VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void;
}