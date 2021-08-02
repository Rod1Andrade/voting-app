<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\CreateVotingOptionDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;

class CreateVotingOptionDataLayer implements ICreateVotingOptionDataLayer
{
    public function __construct(
        private Connection $connection,
        private string     $schema = 'voting.' // TODO: This gonna be replaced by a model with this info (when i use ORM)
    )
    {
    }

    public function store(VotingOptionDTO $votingOptionDTO): void
    {
        $pdo = $this->connection->pdo();
        $votingOptionStatement = $pdo->prepare("INSERT INTO {$this->schema}tb_voting_option ( 
                      voting_option_uuid, voting_uuid, title) VALUES (:votingOptionUuid, :votingUuid, :title)");

        try {
            $votingOptionStatement->bindValue(':votingOptionUuid', $votingOptionDTO->getVotingOptionUuid());
            $votingOptionStatement->bindValue(':votingUuid', $votingOptionDTO->getVotingUuid());
            $votingOptionStatement->bindValue(':title', $votingOptionDTO->getTitle());

            $votingOptionStatement->execute();
        } catch (PDOException $e) {
            throw new CreateVotingOptionDataLayerException($e);
        }

    }

    public function storeAList(array $votingOptions)
    {
        try {
            foreach ($votingOptions as $votingOption) {
                if ($votingOption instanceof VotingOptionDTO) {
                    $this->store($votingOption);
                }
            }
        } catch (PDOException $e) {
            throw new CreateVotingOptionDataLayerException($e);
        }
    }
}