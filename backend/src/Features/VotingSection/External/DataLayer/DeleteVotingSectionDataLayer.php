<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Rodri\VotingApp\App\Database\Connection\Connection;
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
        private Connection $connection,
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid, string $userUuid): void
    {
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare("DELETE FROM {$this->schema}tb_voting
            WHERE voting_uuid = :votingUuid AND user_uuid = :userUuid");

        try {
            $statement->bindValue(':votingUuid', $votingUuid);
            $statement->bindValue(':userUuid', $userUuid);
            $statement->execute();
        } catch (\PDOException $e) {
            throw new DeleteVotingSectionDataLayerException($e);
        }
    }
}