<?php


namespace Features\Auth\External\DataLayer;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;
use Rodri\VotingApp\Features\Auth\External\DataLayer\RegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;

class RegisterUserDataLayerTest extends TestCase
{

    private static UserDTO $dummyUser;

    /**
     * @before
     */
    public function loadUser(): void
    {
        self::$dummyUser = UserDTO::factoryUserDTOfromUser(new User(
            userUuid: new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            email: new Email('any@email.com'),
            password: new Password(PasswordEncrypt::hash('anysecret1234')),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));
    }

    public function testShouldStoreUserInDataBase(): void
    {
        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user');

        if ($dataLayer->hasEmailAlready(new Email(self::$dummyUser->getEmail()))) {
            self::markTestSkipped('Skipped: E-mail already exists');
        }

        $dataLayer->invoke(self::$dummyUser);
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

        # DataLayer with connection expected
        $dataLayer = new RegisterUserDataLayer(MemorySqliteConnection::getConnection());
        $dataLayer->setTableName('tb_user+');

        $dataLayer->invoke(self::$dummyUser);
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