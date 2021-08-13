<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;


use Illuminate\Database\PDO\Connection;
use Illuminate\Support\Facades\DB;
use PDOException;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidCredentialsException;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IAuthenticateUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\AuthenticateUserDataLayerException;
use RuntimeException;

/**
 * Class AuthenticateUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\External\DataLayer
 * @author Rodrigo Andrade
 */
class AuthenticateUserDataLayer implements IAuthenticateUserDataLayer
{

    public function __construct(
        private string $schema = 'voting.'
    )
    {
    }

    public function __invoke(Email $email): ?UserDTO
    {
        try {

            $response = DB::selectOne("SELECT user_id, email, password from {$this->schema}tb_user WHERE email = :email", [
                ':email' => $email
            ]);

            return UserDTO::factoryUserDTOFromStdClass($response);
        } catch (AuthenticateUserDataLayerException $e) {
            throw new AuthenticateUserDataLayerException($e->getMessage());
        } catch (PDOException | RuntimeException) {
            throw new AuthenticateUserDataLayerException();
        }
    }
}
