<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\DeleteVotingSectionDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingSectionDataLayer;

/**
 * Class DeleteVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\External\DataLayer
 * @author Rodrigo Andrade
 */
class DeleteVotingSectionDataLayer implements IDeleteVotingSectionDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid, string $userUuid): void
    {
        try {
            DB::delete(
                "DELETE FROM {$this->schema}tb_voting
                WHERE voting_uuid = :votingUuid AND user_uuid = :userUuid",
                [
                    ':votingUuid' => $votingUuid,
                    ':userUuid' => $userUuid
                ]
            );
        } catch (\PDOException $e) {
            throw new DeleteVotingSectionDataLayerException($e);
        }
    }
}
