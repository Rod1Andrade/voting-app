<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use RuntimeException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingOptionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\ShowVotingSectionDataLayerException;

/**
 * Data Layer - ShowVotingSectionDataLayer
 * @author Rodrigo Andrade
 */
class ShowVotingSectionDataLayer implements IShowVotingSectionDataLayer
{

    public function __construct(
        private string     $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid): ?VotingSectionDTO
    {
        try {
            $response = DB::select(
                "SELECT * FROM {$this->schema}tb_voting tv
                INNER JOIN {$this->schema}tb_voting_option tvo
                ON tv.voting_uuid = tvo.voting_uuid
                WHERE tv.voting_uuid = :votingUuid",
                [
                    ':votingUuid' => $votingUuid
                ]
            );

            if(empty($response)) return null;

            $votingSection = (object) $response[0];
            $votingSection->votingOptions = array_map(function ($value) {
                return VotingOptionDTO::createVotingOptionDTOFromStdClass((object) $value);
            }, $response);

            return VotingSectionDTO::createVotingDTOfromStdClass($votingSection);
        }catch (PDOException | RuntimeException | Exception $e) {
            throw new ShowVotingSectionDataLayerException($e);
        }
    }
}
