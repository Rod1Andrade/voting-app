<?php

namespace Rodri\VotingApp\Features\Auth\External\DataLayer;

use PDOException;
use RuntimeException;
use Illuminate\Support\Facades\DB;
use Rodri\VotingApp\Features\Auth\External\Exceptions\CheckUserExistsDataLayerException;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\ICheckUserExistsDataLayer;

/**
 * DataLayer - CheckUserExistsDataLayer
 * @author Rodrigo Andrade
 */
class CheckUserExistsDataLayer implements ICheckUserExistsDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(string $userUuid): bool
    {
        try {
            $response = DB::selectOne(
                "SELECT user_id from {$this->schema}tb_user WHERE user_id = :userUuid",
                [':userUuid' => $userUuid]
            );

            return !empty($response);
        } catch (CheckUserExistsDataLayerException $e) {
            throw new CheckUserExistsDataLayerException($e->getMessage());
        } catch (PDOException | RuntimeException) {
            throw new CheckUserExistsDataLayerException();
        }
    }
}
