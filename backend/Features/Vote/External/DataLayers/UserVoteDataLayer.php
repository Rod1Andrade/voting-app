<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Vote\External\Exceptions\UserVoteDataLayerException;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;

/**
 * Data Layer - UserVoteDataLayer
 * @author Rodrigo Andrade
 */
class UserVoteDataLayer implements IUserVoteDataLayer
{
    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $userUuid, string $votingUuid, string $votingOptionUuid): void
    {
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare(
            "insert into {$this->schema}tb_vote(user_uuid,voting_uuid, voting_option_uuid) 
            values (:userUuid, :votingUuid, :votingOptionUuid)"
        );

        try {
            $statement->bindValue(':userUuid', $userUuid);
            $statement->bindValue(':votingUuid', $votingUuid);
            $statement->bindValue(':votingOptionUuid', $votingOptionUuid);

            $statement->execute();
        } catch (PDOException $e) {
            throw new UserVoteDataLayerException($e);
        }
    }


}