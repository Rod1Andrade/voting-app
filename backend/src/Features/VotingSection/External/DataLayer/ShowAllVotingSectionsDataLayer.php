<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;

/**
 * Class ShowAllVotingSectionsDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\External\DataLayer
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionsDataLayer implements IShowAllVotingSectionsDataLayer
{

    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(int $offset, int $limit): array
    {
        $result = array();
        $pdo = $this->connection->pdo();

        $statement = $pdo->prepare("SELECT 
                voting_uuid, subject, start_date, finish_date FROM {$this->schema}tb_voting 
                LIMIT :limit OFFSET :offset"
        );

        $statement->bindValue(':offset', $offset);
        $statement->bindValue(':limit', $limit);
        $statement->execute();

        while ($response = $statement->fetch()) {
            $response->votingUuid = $response->voting_uuid;
            $response->startDate = $response->start_date;
            $response->finishDate = $response->finish_date;

            $result[] = VotingDTO::createVotingDTOfromStdClass($response);
        }

        return $result;
    }
}