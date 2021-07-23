<?php


namespace Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects;

use DateTime;
use Exception;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;
use Rodri\VotingApp\Features\Auth\External\Adapters\Uuid;
use RuntimeException;
use stdClass;

/**
 * Class To Transfer data between layers - UserDTO
 * @package Features\Auth\Infra\DataTrasferObjects
 * @author Rodrigo Andrade
 */
class UserDTO
{
    private function __construct(
        private string $userUuid,
        private string $email,
        private string $password,
        private string $birthDate,
        private string $name,
        private string $lastName
    )
    {
    }

    /**
     * @param stdClass $user
     * @param string $uuid
     * @return UserDTO
     */
    public static function factoryUserDTOFromStdClass(stdClass $user, string $uuid = ''): UserDTO
    {
        return new UserDTO(
            userUuid: empty($uuid) ? Uuid::genUUIDv4() : $uuid,
            email: $user->email,
            password: PasswordEncrypt::hash($user->password),
            birthDate: $user->birthDate,
            name: $user->name,
            lastName: $user->lastName
        );
    }
    
    /**
     * Create a instance of User DTO based on User
     * @param User $user
     * @return UserDTO
     */
    public static function factoryUserDTOfromUser(User $user): UserDTO
    {
        return new UserDTO(
            userUuid: $user->getUserUuid()->getValue(),
            email: $user->getEmail()->getValue(),
            password: $user->getPassword()->getValue(),
            birthDate: $user->getBirthDate()->getFormattedDate(),
            name: $user->getName(),
            lastName: $user->getLastname()
        );
    }

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public static function FactoryUserFromDTO(UserDTO $userDTO): User
    {
        try {
            return new User(
                userUuid: new UserUuid($userDTO->getUserUuid()),
                email: new Email($userDTO->getEmail()),
                password: new Password(PasswordEncrypt::hash($userDTO->getPassword())),
                birthDate: new BirthDate(new DateTime($userDTO->getBirthDate())),
                name: $userDTO->getName(),
                lastname: $userDTO->getLastName()
            );
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
    }

    /**
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }

    /**
     * @param string $userUuid
     */
    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
