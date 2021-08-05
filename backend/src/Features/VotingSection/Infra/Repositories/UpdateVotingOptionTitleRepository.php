<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IUpdateVotingOptionTitleRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IUpdateVotingOptionTitleDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\UpdateVotingTitleRepositoryException;

/**
 * Repository Implementation - UpdateVotingOptionTitleRepository
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleRepository implements IUpdateVotingOptionTitleRepository
{

    public function __construct(
        private IUpdateVotingOptionTitleDataLayer $dataLayer
    )
    {
    }

    public function __invoke(Title $title, VotingOptionUuid $votingOptionUuid): void
    {
        try {
            ($this->dataLayer)($title, $votingOptionUuid);
        } catch (Exception $e) {
            throw new UpdateVotingTitleRepositoryException($e);
        }
    }
}