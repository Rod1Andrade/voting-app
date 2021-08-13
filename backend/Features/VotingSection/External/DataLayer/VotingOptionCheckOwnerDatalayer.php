<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\VotingOptionCheckOwnerDataLayerException;

/**
 * DataLayer's implementation - VotingOptionCheckOwnerDatalayer
 * @author Rodrigo Andrade
 */
class VotingOptionCheckOwnerDatalayer implements IVotingOptionCheckOwnerDatalayer
{

    public function __construct(
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingOptionUuid, string $userUuid): bool
    {
        try {
            $response = DB::selectOne(
                "SELECT vto.voting_uuid, vt.user_uuid
                from {$this->schema}tb_voting_option vto
                INNER JOIN {$this->schema}tb_voting vt ON vto.voting_uuid = vt.voting_uuid
                WHERE vto.voting_option_uuid = :votingOptionUuid AND vt.user_uuid = :userUuid",
                [
                    ':votingOptionUuid' => $votingOptionUuid,
                    ':userUuid' => $userUuid
                ]
            );

            return !empty($response);
        } catch (PDOException $e) {
            throw new VotingOptionCheckOwnerDataLayerException($e);
        }
    }
}
