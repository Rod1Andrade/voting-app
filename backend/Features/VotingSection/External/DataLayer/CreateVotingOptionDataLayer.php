<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\CreateVotingOptionDataLayerException;

class CreateVotingOptionDataLayer implements ICreateVotingOptionDataLayer
{
    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function store(VotingOptionDTO $votingOptionDTO): void
    {
        try {
            DB::insert(
                "INSERT INTO {$this->schema}tb_voting_option (
                voting_option_uuid, voting_uuid, title) VALUES (:votingOptionUuid, :votingUuid, :title)",
                [
                    ':votingOptionUuid' => $votingOptionDTO->getVotingOptionUuid(),
                    ':votingUuid' => $votingOptionDTO->getVotingUuid(),
                    ':title' => $votingOptionDTO->getTitle(),
                ]
            );
        } catch (PDOException | Exception $e) {
            throw new CreateVotingOptionDataLayerException($e);
        }
    }

    public function storeAList(array $votingOptions): void
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
