<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;

use PDOException;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;
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
     * @param User $user
     * @codeCoverageIgnore
     */
    public function invoke(User $user): void
    {
        try {
            $pdo = $this->connection->pdo();
            # sql prepare
            $statement = $pdo->prepare(
                "INSERT INTO $this->tableName (user_id, email, password, birth_date, name, last_name)
                  VALUES (:userId, :email, :password, :birthDate, :name, :lastName)"
            );

            # bind
            $statement->bindValue(':userId', $user->getUserUuid()->getValue());
            $statement->bindValue(':email', $user->getEmail()->getValue());
            $statement->bindValue(':password', $user->getPassword()->getValue());
            $statement->bindValue(':birthDate', $user->getBirthDate()->getFormattedDate());
            $statement->bindValue(':name', $user->getName());
            $statement->bindValue(':lastName', $user->getLastname());

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