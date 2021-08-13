<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\DeleteVotingOptionDataLayerException;

/**
 * Data Layer - DeleteVotingOptionDataLayer
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionDataLayer implements IDeleteVotingOptionDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingOptionUuid): void
    {
        try {
            DB::delete(
                "DELETE FROM {$this->schema}tb_voting_option
                WHERE voting_option_uuid = :votingOptionUuid",
                [
                    ':votingOptionUuid' => $votingOptionUuid
                ]
            );
        } catch (PDOException $e) {
            throw new DeleteVotingOptionDataLayerException($e);
        }
    }
}
