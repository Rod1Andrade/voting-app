<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;


use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
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
        private Connection $connection,
        private string $tableName = 'voting.tb_user'
    )
    {
    }

    /**
     * Set te appropriated name for table.
     * @param string $tableName
     * @codeCoverageIgnore
     */
    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    public function __invoke(Email $email): UserDTO
    {
        try {
            $pdo = $this->connection->pdo();
            $statement = $pdo->prepare("SELECT user_id, email, password from $this->tableName WHERE email = :email LIMIT 1");
            $statement->bindValue(':email', $email->getValue());
            $statement->execute();

            $stdClass = $statement->fetch();

            if($stdClass === false)
                throw new InvalidCredentialsException('Credential not match');

            return UserDTO::factoryUserDTOFromStdClass($stdClass);
        } catch (PDOException | RuntimeException $e) {
            throw new AuthenticateUserDataLayerException($e);
        }
    }
}