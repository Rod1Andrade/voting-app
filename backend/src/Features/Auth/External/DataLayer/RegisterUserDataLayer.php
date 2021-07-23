<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;
use RuntimeException;

/**
 * Data Layer - RegisterUserDataLayer
 * @package Rodri\VotingApp\Features\Auth\External\DataLayer
 * @author Rodrigo Andrade
 */
class RegisterUserDataLayer implements IRegisterUserDataLayer
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
     */
    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }


    /**
     * @param UserDTO $userDTO
     * @codeCoverageIgnore
     */
    public function invoke(UserDTO $userDTO): void
    {
        try {
            $pdo = $this->connection->pdo();
            # sql prepare
            $statement = $pdo->prepare(
                "INSERT INTO $this->tableName (user_id, email, password, birth_date, name, last_name)
                  VALUES (:userId, :email, :password, :birthDate, :name, :lastName)"
            );

            # bind
            $statement->bindValue(':userId', $userDTO->getUserUuid());
            $statement->bindValue(':email', $userDTO->getEmail());
            $statement->bindValue(':password', $userDTO->getPassword());
            $statement->bindValue(':birthDate', $userDTO->getBirthDate());
            $statement->bindValue(':name', $userDTO->getName());
            $statement->bindValue(':lastName', $userDTO->getLastname());

            $statement->execute();
        } catch (PDOException | RuntimeException $e) {
            throw new RegisterUserDataLayerException($e);
        }
    }

    /**
     * @param Email $email
     * @return bool
     */
    public function hasEmailAlready(Email $email): bool
    {
        try {
            $pdo = $this->connection->pdo();
            $statement = $pdo->prepare("SELECT email from $this->tableName WHERE email = :email");
            $statement->bindValue(':email', $email->getValue());
            $statement->execute();

            return !empty($statement->fetch());
        } catch (PDOException | RuntimeException $e) {
            throw new RegisterUserDataLayerException($e);
        }
    }
}