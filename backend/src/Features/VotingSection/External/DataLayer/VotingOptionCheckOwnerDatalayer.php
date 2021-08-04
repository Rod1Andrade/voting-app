<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\VotingOptionCheckOwnerDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingOptionCheckOwnerDatalayer;

/**
 * DataLayer's implementation - VotingOptionCheckOwnerDatalayer
 * @author Rodrigo Andrade
 */
class VotingOptionCheckOwnerDatalayer implements IVotingOptionCheckOwnerDatalayer
{

    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingOptionUuid, string $userUuid): bool
    {
        $pdo = $this->connection->pdo();
        $statement = $pdo->prepare(
            "SELECT vto.voting_uuid, vt.user_uuid
                from {$this->schema}tb_voting_option vto
                INNER JOIN {$this->schema}tb_voting vt ON vto.voting_uuid = vt.voting_uuid
                WHERE vto.voting_option_uuid = :votingOptionUuid AND vt.user_uuid = :userUuid"
        );

        try {
            $statement->bindValue('votingOptionUuid', $votingOptionUuid);
            $statement->bindValue('userUuid', $userUuid);

            $statement->execute();

            return !empty($statement->fetch());
        } catch (PDOException $e) {
            throw new VotingOptionCheckOwnerDataLayerException($e);
        }
    }
}