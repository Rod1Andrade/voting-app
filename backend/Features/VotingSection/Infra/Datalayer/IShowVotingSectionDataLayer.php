<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;

/**
 * Data Layer IShowVotingSectionDataLayer
 * @author Rodrigo Andrade
 */
interface IShowVotingSectionDataLayer
{

    /**
     * @param string $votingUuid
     * @return VotingSectionDTO|null
     */
    public function __invoke(string $votingUuid): ?VotingSectionDTO;
}
