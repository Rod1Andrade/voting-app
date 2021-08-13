<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\ShowAllVotingSectionsDataLayerException;

/**
 * Class ShowAllVotingSectionsDataLayer
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionsDataLayer implements IShowAllVotingSectionsDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(int $offset, int $limit): array
    {
        try {
            $response = DB::select(
                "SELECT voting_uuid, subject, start_date, finish_date FROM {$this->schema}tb_voting
                LIMIT :limit OFFSET :offset",
                [
                    ':offset' => $offset,
                    ':limit' => $limit,
                ]
            );

            return array_map(function ($value) {
                return VotingSectionDTO::createVotingDTOfromStdClass((object) $value);
            }, $response);
        } catch (PDOException | Exception $e) {
            throw new ShowAllVotingSectionsDataLayerException($e);
        }
    }
}
