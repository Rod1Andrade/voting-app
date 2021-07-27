<?php


namespace Rodri\VotingApp\Features\Auth\Domain\Entities;


use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

/**
 * Entity User
 * @package Rodri\VotingApp\Features\Auth\Domain\Entities
 * @author Rodrigo Andrade
 */
class User
{
    /**
     * User constructor.
     * @param UserUuid|null $userUuid
     * @param Email|null $email
     * @param Password|null $password
     * @param BirthDate|null $birthDate
     * @param string|null $name
     * @param string|null $lastname
     */
    public function __construct(
        private ?UserUuid $userUuid = null,
        private ?Email $email = null,
        private ?Password $password = null,
        private ?BirthDate $birthDate = null,
        private ?string $name = null,
        private ?string $lastname = null
    )
    {
    }

    /**
     * @return UserUuid|null
     */
    public function getUserUuid(): ?UserUuid
    {
        return $this->userUuid;
    }

    /**
     * @param UserUuid|null $userUuid
     */
    public function setUserUuid(?UserUuid $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return Email|null
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @param Email|null $email
     */
    public function setEmail(?Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Password|null
     */
    public function getPassword(): ?Password
    {
        return $this->password;
    }

    /**
     * @param Password|null $password
     */
    public function setPassword(?Password $password): void
    {
        $this->password = $password;
    }

    /**
     * @return BirthDate|null
     */
    public function getBirthDate(): ?BirthDate
    {
        return $this->birthDate;
    }

    /**
     * @param BirthDate|null $birthDate
     */
    public function setBirthDate(?BirthDate $birthDate): void
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
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

}