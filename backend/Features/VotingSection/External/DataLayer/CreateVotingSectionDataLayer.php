<?php


namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;


use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingSectionDataLayer;

/**
 * Class CreateVotingSectionDataLayer
 * @package Rodri\VotingApp\Features\VotingSection\External\DataLayer
 * @author Rodrigo Andrade
 */
class CreateVotingSectionDataLayer implements ICreateVotingSectionDataLayer
{

    public function __construct(
        private ICreateVotingOptionDataLayer $createVotingOptionDataLayer,
        private string                       $schema = 'voting.'
    )
    {
    }

    public function __invoke(VotingSectionDTO $votingDTO): void
    {
        try {
            DB::beginTransaction();

            # Aggregate
            DB::insert(
                "INSERT INTO {$this->schema}tb_voting(user_uuid, voting_uuid, subject, start_date, finish_date)
                VALUES (:userUuid, :votingUuid, :subject, :startDate, :finishDate)",
                [
                    ':userUuid' => $votingDTO->getUserUuid(),
                    ':votingUuid' => $votingDTO->getVotingUuid(),
                    ':subject' => $votingDTO->getSubject(),
                    ':startDate' => $votingDTO->getStartDate(),
                    ':finishDate' => $votingDTO->getFinishDate(),

                ]
            );

            # One to many relation
            $this->createVotingOptionDataLayer->storeAList($votingDTO->getVotingOptions());

            DB::commit();
        } catch (PDOException | Exception) {
            DB::rollBack();
        }
    }
}
