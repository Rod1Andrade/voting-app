<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\DeleteVotingOptionDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingOptionDataLayer;

/**
 * Data Layer - DeleteVotingOptionDataLayer
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionDataLayer implements IDeleteVotingOptionDataLayer
{

    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingOptionUuid, string $userUuid): void
    {
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare(
            "DELETE FROM {$this->schema}tb_voting_option
                WHERE voting_option_uuid = :votingOptionUuid");

        try {
            $statement->bindValue('votingOptionUuid', $votingOptionUuid);
            $statement->execute();
        } catch (PDOException $e) {
            throw new DeleteVotingOptionDataLayerException($e);
        }

    }
}