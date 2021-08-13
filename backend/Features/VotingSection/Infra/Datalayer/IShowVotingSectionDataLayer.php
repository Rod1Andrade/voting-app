<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;

/**
 * Data Layer IShowVotingSectionDataLayer
 * @author Rodrigo Andrade
 */
interface IShowVotingSectionDataLayer
{

    /**
     * @param string $votingUuid
     * @return VotingDTO|null
     */
    public function __invoke(string $votingUuid): ?VotingDTO;
}