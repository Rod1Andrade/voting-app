<?php


namespace Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects;

use DateTime;
use Exception;
use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
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
        private ?string $userUuid,
        private ?string $email,
        private ?string $password,
        private ?string $birthDate,
        private ?string $name,
        private ?string $lastName
    )
    {
    }

    /**
     * @param array $user
     * @return UserDTO
     */
    #[Pure] public static function factoryUserDTOFromArray(array $user): UserDTO
    {
        return new UserDTO(
            userUuid: $user['userUuid'] ?? null,
            email: $user['email'] ?? null,
            password: $user['password'] ?? null,
            birthDate: $user['birthDate'] ?? null,
            name: $user['name'] ?? null,
            lastName: $user['lastName'] ?? null
        );
    }

    /**
     * @param stdClass $user
     * @return UserDTO
     */
    #[Pure] public static function factoryUserDTOFromStdClass(stdClass $user): UserDTO
    {
        return new UserDTO(
            userUuid: $user->userUuid ?? $user->user_id ?? null,
            email: $user->email ?? null,
            password: $user->password ?? null,
            birthDate: $user->birthDate ??null,
            name: $user->name ?? null,
            lastName: $user->lastName ?? null
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
            userUuid: $user->getUserUuid()?->getValue(),
            email: $user->getEmail()?->getValue(),
            password: $user->getPassword()?->getValue(),
            birthDate: $user->getBirthDate()?->getFormattedDate(),
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
                userUuid: $userDTO->userUuid ? new UserUuid($userDTO->getUserUuid()) : null,
                email: $userDTO->email ? new Email($userDTO->getEmail()) : null,
                password: $userDTO->password ? new Password($userDTO->getPassword()) : null,
                birthDate: $userDTO->birthDate ? new BirthDate(new DateTime($userDTO->getBirthDate())) : null,
                name: $userDTO->email ? $userDTO->getName(): null,
                lastname: $userDTO->lastName ? $userDTO->getLastName() : null
            );
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
    }

    /**
     * @return string|null
     */
    public function getUserUuid(): ?string
    {
        return $this->userUuid;
    }

    /**
     * @param string|null $userUuid
     */
    public function setUserUuid(?string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @param string|null $birthDate
     */
    public function setBirthDate(?string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

}
