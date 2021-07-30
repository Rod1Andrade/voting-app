<?php


namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;


use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;

/**
 * Class CreateVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\External\DataLayer
 * @author Rodrigo Andrade
 */
class CreateVotingSectionDataLayer implements ICreateVotingSectionDataLayer
{

    public function __construct(
        private Connection $connection,
        private string $schema = 'voting.' // TODO: This gonna be replaced by a model with this info (when i use ORM)
    )
    {
    }

    public function __invoke(VotingDTO $votingDTO): void
    {

        $pdo = $this->connection->pdo();
        $votingStatement = $pdo->prepare("INSERT INTO {$this->schema}tb_voting(
                      voting_uuid, subject, start_date, finish_date) VALUES (:votingUuid, :subject, :startDate, :finishDate)");
        $votingStatement->bindValue(':votingUuid', $votingDTO->getVotingUuid());
        $votingStatement->bindValue(':subject', $votingDTO->getSubject());
        $votingStatement->bindValue(':startDate', $votingDTO->getStartDate());
        $votingStatement->bindValue(':finishDate', $votingDTO->getFinishDate());

        $votingOptionStatement = $pdo->prepare("INSERT INTO {$this->schema}tb_voting_option ( 
                      voting_option_uuid, voting_uuid, title) VALUES (:votingOptionUuid, :votingUuid, :title)");

        $pdo->beginTransaction();
        try {
            # Aggregate
            $votingStatement->execute();

            # One to many relation
            foreach ($votingDTO->getVotingOptions() as $votingOption) {
                if ($votingOption instanceof VotingOptionDTO) {
                    $votingOptionStatement->bindValue(':votingOptionUuid', $votingOption->getVotingOptionUuid());
                    $votingOptionStatement->bindValue(':votingUuid', $votingOption->getVotingUuid());
                    $votingOptionStatement->bindValue(':title', $votingOption->getTitle());

                    $votingOptionStatement->execute();
                }
            }
        } catch (PDOException) {
            $pdo->rollBack();
        }

        $pdo->commit();
    }
}