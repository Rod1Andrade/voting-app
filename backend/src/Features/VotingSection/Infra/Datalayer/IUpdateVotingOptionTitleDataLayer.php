<?php

namespace Rodri\VotingApp\Features\VotingSection\Infra\Datalayer;

/**
 * Data Layer - IUpdateVotingOptionTitleDataLayer
 * @author Rodrigo Andrade
 */
interface IUpdateVotingOptionTitleDataLayer
{
    /**
     * @param string $title
     * @param string $votingOptionUuid
     */
    public function __invoke(string $title, string $votingOptionUuid): void;

}