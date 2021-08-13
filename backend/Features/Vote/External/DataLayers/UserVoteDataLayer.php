<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\Vote\External\Exceptions\UserVoteDataLayerException;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;

/**
 * Data Layer - UserVoteDataLayer
 * @author Rodrigo Andrade
 */
class UserVoteDataLayer implements IUserVoteDataLayer
{
    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $userUuid, string $votingUuid, string $votingOptionUuid): void
    {
        try {
            DB::insert(
                "insert into {$this->schema}tb_vote(user_uuid,voting_uuid, voting_option_uuid)
                values (:userUuid, :votingUuid, :votingOptionUuid)",
                [
                    ':userUuid' => $userUuid,
                    ':votingUuid' => $votingUuid,
                    ':votingOptionUuid' => $votingOptionUuid,
                ]
            );
        } catch (PDOException $e) {
            throw new UserVoteDataLayerException($e);
        }
    }
}
