<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Vote\External\Exceptions\UserVoteDataLayerException;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;

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

    public function __invoke(VoteDTO $voteDTO): void
    {
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare(
            "insert into {$this->schema}tb_vote(user_uuid,voting_option_uuid,voting_uuid
            ) values (:userUuid,:votingOptionUuid,:votingUuid)");

        try {
            $statement->bindValue(':userUuid', $voteDTO->getUserUuid());
            $statement->bindValue(':votingOptionUuid', $voteDTO->getVotingOptionUuid());
            $statement->bindValue(':votingUuid', $voteDTO->getVotingUuid());

            $statement->execute();
        } catch (PDOException $e) {
            throw new UserVoteDataLayerException($e);
        }
    }
}