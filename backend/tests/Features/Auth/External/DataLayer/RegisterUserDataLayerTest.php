<?php


namespace Features\Auth\External\DataLayer;


use DateTime;
use PDO;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\DataLayer\RegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;

class RegisterUserDataLayerTest extends TestCase
{
    public function testConnection(): void
    {
        self::assertInstanceOf(PDO::class, MemorySqliteConnection::getConnection()->pdo());
    }

    public function testShouldStoreUserInDataBase(): void
    {

        $uuidMock = self::createMock(IUuid::class);
        $uuidMock->method('genUUIDv4')
            ->willReturn('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc');

        $dummyUser = new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any@email.com'),
            password: new Password('anypassword1234'),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        );

        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user');

        if($dataLayer->hasEmailAlready($dummyUser->getEmail())) {
            self::markTestSkipped('Skipped: E-mail already exists');
        }

        $dataLayer->invoke($dummyUser);
        self::assertTrue(true);
    }

    public function testShouldReturnTrueIfEmailAlreadyExist(): void
    {
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user');

        self::assertTrue($dataLayer->hasEmailAlready(new Email('any@email.com')));
    }

    public function testShouldReturnFalseIfEmailNotExists(): void
    {
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user');

        self::assertFalse($dataLayer->hasEmailAlready(new Email('anyd@email.com')));
    }

    public function testShouldThrowARegisterUserDataLayerExceptionWhenIsImpossibleStoreAUser(): void
    {
        self::expectException(RegisterUserDataLayerException::class);
        $uuidMock = self::createMock(IUuid::class);
        $uuidMock->method('genUUIDv4')
            ->willReturn('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc');

        $dummyUser = new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any@email.com'),
            password: new Password('anypassword1234'),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        );

        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user+');

        $dataLayer->invoke($dummyUser);
    }


    public function testShouldThrowARegisterUserDataLayerExceptionWhenIsImpossibleCheckIfEmailAlreadyExist(): void
    {
        self::expectException(RegisterUserDataLayerException::class);
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user+');

        $dataLayer->hasEmailAlready(new Email('any@emial.com'));
    }
}