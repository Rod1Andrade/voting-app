<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\ShowVotingSectionRepositoryException;

/**
 * Repository ShowVotingSectionRepository
 * @author Rodrigo Andrade
 */
class ShowVotingSectionRepository implements IShowVotingSectionRepository
{

    public function __construct(
        private IShowVotingSectionDataLayer $dataLayer
    )
    {
    }

    public function __invoke(VotingUuid $votingUuid): ?Voting
    {
        try {
            return VotingSectionDTO::createVotingFromVotingDTO(($this->dataLayer)($votingUuid->getValue()));
        } catch (Exception $e) {
            throw new ShowVotingSectionRepositoryException($e);
        }
    }
}
