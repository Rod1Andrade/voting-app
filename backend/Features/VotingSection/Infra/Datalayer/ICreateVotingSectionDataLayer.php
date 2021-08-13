<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use RuntimeException;

/**
 * Interface ICreatedVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\Infra\Datalayer
 * @author Rodrigo Andrade
 */
interface ICreateVotingSectionDataLayer
{
    /**
     * @param VotingSectionDTO $votingDTO
     * @throws RuntimeException
     */
    public function __invoke(VotingSectionDTO $votingDTO): void;
}
