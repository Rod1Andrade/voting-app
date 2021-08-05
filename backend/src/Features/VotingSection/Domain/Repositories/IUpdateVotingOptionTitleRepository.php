<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\Repositories;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Repository - IUpdateVotingOptionRepository
 * @author Rodrigo Andrade
 */
interface IUpdateVotingOptionTitleRepository
{
    /**
     * Update a voting title.
     *
     * @param Title $title
     * @param VotingOptionUuid $votingOptionUuid
     */
    public function __invoke(Title $title, VotingOptionUuid $votingOptionUuid): void;
}