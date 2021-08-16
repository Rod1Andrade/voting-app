<?php

namespace Rodri\VotingApp\Features\Vote\External\DataLayers;

use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IVoteResultDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteResultDTO;
use Rodri\VotingApp\Features\Vote\External\Exceptions\VoteResultDataLayerException;

/**
 * Implements - IVoteResultDataLayer
 * @author Rodrigo Andrade
 */
class VoteResultDataLayer implements IVoteResultDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid): ?VoteDTO
    {
        try {
            $response = DB::select(
                "select count(voting_option.voting_option_uuid) as quantity,
                   voting_option.title,
                   voting.subject,
                   voting.start_date,
                   voting.finish_date,
                   vote.voting_uuid,
                   vote.voting_option_uuid
            from {$this->schema}tb_vote vote
             join(
                select title, voting_option_uuid
                from voting.tb_voting_option
            ) as voting_option on voting_option.voting_option_uuid = vote.voting_option_uuid
             join (
                select subject, voting_uuid, start_date, finish_date from voting.tb_voting
            ) as voting on voting.voting_uuid = vote.voting_uuid
            where vote.voting_uuid = :votingUuid
            group by voting_option.title,
                     voting.subject,
                     voting.start_date,
                     voting.finish_date,
                     vote.voting_uuid,
                     vote.voting_option_uuid",
                [
                    ':votingUuid' => $votingUuid
                ]
            );

            if(empty($response)) return null;

            $vote = (object) $response[0];
            $vote->voteResults = array_map(function($value) {
                return VoteResultDTO::createVoteResultDTOFromStdClass((object) $value);
            }, $response);

            return VoteDTO::createVoteDTOFromStdClass($vote);
        } catch (PDOException | Exception $e) {
            throw new VoteResultDataLayerException($e);
        }
    }
}
