<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Vote\External\Exceptions\CheckUserAlreadyVoteDataLayerException;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\ICheckUserAlreadyVoteDataLayer;

/**
 * Data Layer implementation - CheckUserAlreadyVoteDataLayer
 * @author Rodrigo Andrade
 */
class CheckUserAlreadyVoteDataLayer implements ICheckUserAlreadyVoteDataLayer
{

    public function __construct(
        private Connection $connection,
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $userUuid, string $votingUuid): bool
    {
        $pdo = $this->connection->pdo();
        
        $statement = $pdo->prepare("
            select user_uuid 
            from {$this->schema}tb_vote
            where user_uuid = :userUuid and voting_uuid = :votingUuid"
        );

        try {
            $statement->bindValue(':userUuid', $userUuid);
            $statement->bindValue(':votingUuid', $votingUuid);

            $statement->execute();

            return !empty($statement->fetch());
        } catch (\PDOException $e) {
            throw new CheckUserAlreadyVoteDataLayerException($e);
        }
    }
}