<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\ICheckUserAlreadyVoteDataLayer;
use Rodri\VotingApp\Features\Vote\External\Exceptions\CheckUserAlreadyVoteDataLayerException;

/**
 * Data Layer implementation - CheckUserAlreadyVoteDataLayer
 * @author Rodrigo Andrade
 */
class CheckUserAlreadyVoteDataLayer implements ICheckUserAlreadyVoteDataLayer
{
    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $userUuid, string $votingUuid): bool
    {
        try {
            $response = DB::selectOne(
                "select user_uuid
                from {$this->schema}tb_vote
                where user_uuid = :userUuid and voting_uuid = :votingUuid",
                [
                    ':userUuid' => $userUuid,
                    ':votingUuid' => $votingUuid
                ]
            );

            return !empty($response);
        } catch (PDOException $e) {
            throw new CheckUserAlreadyVoteDataLayerException($e);
        }
    }
}
