<?php


namespace Features\Auth\Domain\Entities;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidEmailException;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;

class UserTest extends TestCase
{
    private static User $user;

    /**
     * @before
     */
    public function loadUser(): void
    {
        self::$user = new User(
            new UserUuid(Uuid::genUUIDv4()),
            new Email('any@email.com'),
            new Password(PasswordEncrypt::hash('anysecret1234')),
            new BirthDate(new DateTime('now')), 'any', 'any');
    }

    public function testShouldThrowAInvalidEmailExceptionWhenHasAInvalidEmail(): void
    {
        self::expectException(InvalidEmailException::class);

        self::$user = new User(
            new UserUuid(Uuid::genUUIDv4()),
            new Email('any@email.com.'),
            new Password('anysecret1234'),
            new BirthDate(new DateTime('now')), 'any', 'any');
    }

    public function testShouldGenerateAuuid(): void
    {
        self::assertIsString(self::$user->getUserUuid()->getValue());
    }

    public function testShouldHashAPasswordOfUser(): void
    {
        self::assertIsString(self::$user->getPassword()->getValue());
    }

    public function testShouldCheckAPasswordAndReturnTrueIfAreEquals(): void
    {
        self::assertTrue(self::$user->getPassword()->check('anysecret1234'));
    }

    public function testShouldCheckIfEmailIsValid():void
    {
        self::assertTrue(Email::isValid('rod1dev@gmail.com'));
    }

    public function testShouldCheckIfEmailIsNotValid():void
    {
        self::assertFalse(Email::isValid('any@email..com'));
    }
}