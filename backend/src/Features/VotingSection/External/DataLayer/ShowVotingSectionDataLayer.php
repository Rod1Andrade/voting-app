<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\ShowVotingSectionDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;
use RuntimeException;
use stdClass;

/**
 * Data Layer - ShowVotingSectionDataLayer
 * @author Rodrigo Andrade
 */
class ShowVotingSectionDataLayer implements IShowVotingSectionDataLayer
{

    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid): ?VotingDTO
    {
        $pdo = $this->connection->pdo();
        $statement = $pdo->prepare("SELECT * FROM {$this->schema}tb_voting tv
                INNER JOIN {$this->schema}tb_voting_option tvo 
                ON tv.voting_uuid = tvo.voting_uuid
                WHERE tv.voting_uuid = :votingUuid");

        try {
            $statement->bindValue(':votingUuid', $votingUuid);

            $statement->execute();
            $response = $statement->fetchAll();

            if(empty($response)) return null;

            $votingStdClass = new stdClass();
            $votingStdClass->userUuid = $response[0]->user_uuid;
            $votingStdClass->votingUuid = $response[0]->voting_uuid;
            $votingStdClass->subject = $response[0]->subject;
            $votingStdClass->startDate = $response[0]->start_date;
            $votingStdClass->finishDate = $response[0]->finish_date;

            $votingStdClass->votingOptions = array_map(function ($value) {
                $votingOptionStdClass = new stdClass();
                $votingOptionStdClass->title = $value->title;
                $votingOptionStdClass->votingOptionUuid = $value->voting_option_uuid;

                return VotingOptionDTO::createVotingOptionDTOFromStdClass($votingOptionStdClass);
            }, $response);

            return VotingDTO::createVotingDTOfromStdClass($votingStdClass);
        } catch (PDOException | RuntimeException | Exception $e) {
            throw new ShowVOtingSectionDataLayerException($e);
        }
    }
}