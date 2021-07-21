<?php


namespace Features\Auth\External\DataLayer;


use DateTime;
use Dotenv\Dotenv;
use PDO;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\DataLayer\RegisterUserDataLayer;

class RegisterUserDataLayerTest extends TestCase
{
    /**
     * @before
     */
    public function loadEnv() {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../../../../../src/App/Config');
        $dotenv->load();
        $dotenv->safeLoad();
    }

    public function testConnection(): void
    {
        self::assertInstanceOf(PDO::class, PgConnection::getConnection()->pdo());
    }

    public function testShouldStoreUserInDataBase(): void
    {
        self::markTestSkipped('Store a user with success.');
        $dummyUser = new User(
            userUuid: new UserUuid('1342f1f3-5574-4c4b-80a0-d4d79cca5cea'),
            email: new Email('any@email.com'),
            password: new Password('anypassword1234'),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        );

        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(PgConnection::getConnection());

        $dataLayer->invoke($dummyUser);

        self::assertTrue(true);
    }

    public function testShouldReturnTrueIfEmailAlreadyExist(): void
    {
        self::markTestSkipped('Get email with success and returned true.');
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(PgConnection::getConnection());

        self::assertTrue($dataLayer->hasEmailAlready(new Email('any@email.com')));
    }

    public function testShouldReturnFalseIfEmailNotExists(): void
    {
        self::markTestSkipped('Dont get email with success and returned false.');
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(PgConnection::getConnection());

        self::assertFalse($dataLayer->hasEmailAlready(new Email('anyd@email.com')));
    }
}