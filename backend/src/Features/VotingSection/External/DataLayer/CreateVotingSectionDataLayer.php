<?php


namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;


use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;

/**
 * Class CreateVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\External\DataLayer
 * @author Rodrigo Andrade
 */
class CreateVotingSectionDataLayer implements ICreateVotingSectionDataLayer
{

    public function __construct(
        private Connection $connection,
        private ICreateVotingOptionDataLayer $votingOptionDataLayer,
        private string $schema = 'voting.' // TODO: This gonna be replaced by a model with this info (when i use ORM)
    )
    {
    }

    public function __invoke(VotingDTO $votingDTO): void
    {

        $pdo = $this->connection->pdo();
        $votingStatement = $pdo->prepare("INSERT INTO {$this->schema}tb_voting(user_uuid,
                      voting_uuid, subject, start_date, finish_date) VALUES (:userUuid, :votingUuid, :subject, :startDate, :finishDate)");

        $votingStatement->bindValue(':userUuid', $votingDTO->getUserUuid());
        $votingStatement->bindValue(':votingUuid', $votingDTO->getVotingUuid());
        $votingStatement->bindValue(':subject', $votingDTO->getSubject());
        $votingStatement->bindValue(':startDate', $votingDTO->getStartDate());
        $votingStatement->bindValue(':finishDate', $votingDTO->getFinishDate());

        $pdo->beginTransaction();
        try {
            # Aggregate
            $votingStatement->execute();

            # One to many relation
            $this->votingOptionDataLayer->storeAList($votingDTO->getVotingOptions());

        } catch (PDOException) {
            $pdo->rollBack();
        }

        $pdo->commit();
    }
}