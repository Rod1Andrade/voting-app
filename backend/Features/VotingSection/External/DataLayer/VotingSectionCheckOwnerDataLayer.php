<?php

namespace Rodri\VotingApp\Features\VotingSection\External\DataLayer;

use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IVotingSectionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\External\Exceptions\VotingSectionCheckOwnerDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingSectionCheckOwnerDataLayer;

/**
 * Data Layer implementation - VotingSectionCheckOwnerDataLayer
 * @author Rodrigo Andrade
 */
class VotingSectionCheckOwnerDataLayer implements IVotingSectionCheckOwnerDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $votingUuid, string $userUuid): bool
    {
        try {
            $response = DB::selectOne(
                "SELECT voting_uuid, user_uuid FROM {$this->schema}tb_voting
                WHERE voting_uuid = :votingUuid AND user_uuid = :userUuid",
                [
                    ':votingUuid' => $votingUuid,
                    ':userUuid' => $userUuid
                ]
            );
            return !empty($response);
        } catch (\PDOException | \Exception $e) {
            throw new VotingSectionCheckOwnerDataLayerException($e);
        }
    }
}
