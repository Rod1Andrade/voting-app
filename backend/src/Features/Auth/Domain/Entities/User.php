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
     * @param UserUuid $userUuid
     * @param Email $email
     * @param Password $password
     * @param BirthDate $birthDate
     * @param string $name
     * @param string $lastname
     */
    public function __construct(
        private UserUuid $userUuid,
        private Email $email,
        private Password $password,
        private BirthDate $birthDate,
        private string $name,
        private string $lastname
    )
    {
    }

    /**
     * @return UserUuid
     */
    public function getUserUuid(): UserUuid
    {
        return $this->userUuid;
    }

    /**
     * @param UserUuid $userUuid
     * @codeCoverageIgnore
     */
    public function setUserUuid(UserUuid $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @codeCoverageIgnore
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @param Password $password
     * @codeCoverageIgnore
     */
    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    /**
     * @return BirthDate
     * @codeCoverageIgnore
     */
    public function getBirthDate(): BirthDate
    {
        return $this->birthDate;
    }

    /**
     * @param BirthDate $birthDate
     * @codeCoverageIgnore
     */
    public function setBirthDate(BirthDate $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @codeCoverageIgnore
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @codeCoverageIgnore
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }
}