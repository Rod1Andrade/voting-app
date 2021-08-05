<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\UpdateVotingOptionTitleDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IUpdateVotingOptionTitleDataLayer;

/**
 * DataLayer - UpdateVotingOptionTitleDataLayer
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleDataLayer implements IUpdateVotingOptionTitleDataLayer
{

    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $title, string $votingOptionUuid): void
    {
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare(
            "UPDATE {$this->schema}tb_voting_option
                SET title = :title
                WHERE voting_option_uuid = :votingOptionUuid"
        );

        try {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':votingOptionUuid', $votingOptionUuid);

            $statement->execute();
        } catch (PDOException | Exception $e) {
            var_dump($e);
            throw new UpdateVotingOptionTitleDataLayerException($e);
        }
    }
}