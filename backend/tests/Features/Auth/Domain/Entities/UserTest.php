<?php


namespace Features\Auth\Domain\Entities;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IPasswordEncrypt;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

class UserTest extends TestCase
{
    private static User $user;

    /**
     * @before
     */
    public function loadUser(): void
    {
        $uuidMock = self::createMock(IUuid::class);
        $uuidMock->method('genUUIDv4')
            ->willReturn('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc');

        $passwordEncryptMock = self::createMock(IPasswordEncrypt::class);
        $passwordEncryptMock->method('hash')
            ->willReturn(password_hash('anysecret1234', PASSWORD_DEFAULT));

        $passwordEncryptMock
            ->method('check')
            ->willReturn(
                password_verify('anysecret1234', '$2y$10$7RL5ZSfCcsdKDeAnLnb1UO1PRUSKXsqsaNRTuYbwKDVnpYUvsBt.u')
            );

        self::$user = new User(
            new UserUuid($uuidMock),
            new Email('any@email.com'),
            new Password('anysecret1234', $passwordEncryptMock),
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
}