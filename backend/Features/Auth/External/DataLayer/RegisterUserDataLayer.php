<?php


namespace Rodri\VotingApp\Features\Auth\External\DataLayer;

use Illuminate\Support\Facades\DB;
use PDOException;
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
        private string $schema = 'voting.'
    )
    {
    }

    /**
     * @param UserDTO $userDTO
     * @codeCoverageIgnore
     */
    public function invoke(UserDTO $userDTO): void
    {
        try {
            DB::insert(
                "INSERT INTO {$this->schema}tb_user (user_id, email, password, birth_date, name, last_name)
                VALUES (:userId, :email, :password, :birthDate, :name, :lastName)",
                [
                    ':userId' => $userDTO->getUserUuid(),
                    ':email' => $userDTO->getEmail(),
                    ':password' => $userDTO->getPassword(),
                    ':birthDate' => $userDTO->getBirthDate(),
                    ':name' => $userDTO->getName(),
                    ':lastName' => $userDTO->getLastName()
                ]
            );

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
            $response = DB::selectOne("SELECT email from {$this->schema}tb_user WHERE email = :email", [
                ':email' => $email->getValue()
            ]);

            return !empty($response);
        } catch (PDOException | RuntimeException $e) {
            throw new RegisterUserDataLayerException($e);
        }
    }
}
