<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IUpdateVotingOptionTitleDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\UpdateVotingOptionTitleDataLayerException;

/**
 * DataLayer - UpdateVotingOptionTitleDataLayer
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleDataLayer implements IUpdateVotingOptionTitleDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $title, string $votingOptionUuid): void
    {
        try {
            DB::update(
                "UPDATE {$this->schema}tb_voting_option
                SET title = :title
                WHERE voting_option_uuid = :votingOptionUuid",
                [
                    ':title' => $title,
                    ':votingOptionUuid' => $votingOptionUuid
                ]
            );
        } catch (PDOException | Exception $e) {
            var_dump($e);
            throw new UpdateVotingOptionTitleDataLayerException($e);
        }
    }
}
