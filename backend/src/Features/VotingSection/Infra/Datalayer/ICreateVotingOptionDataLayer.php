<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;

interface ICreateVotingOptionDataLayer
{
    /**
     * Store a unique instance of voting option
     * @param VotingOptionDTO $votingOptionDTO
     */
    public function store(VotingOptionDTO $votingOptionDTO): void;

    /**
     * Store a list of voting options
     * @param array $votingOptions
     * @return mixed
     */
    public function storeAList(array $votingOptions);
}