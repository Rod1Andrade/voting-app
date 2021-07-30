<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use RuntimeException;

/**
 * Interface ICreatedVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\Infra\Datalayer
 * @author Rodrigo Andrade
 */
interface ICreateVotingSectionDataLayer
{
    /**
     * @param VotingDTO $votingDTO
     * @throws RuntimeException
     */
    public function __invoke(VotingDTO $votingDTO): void;
}