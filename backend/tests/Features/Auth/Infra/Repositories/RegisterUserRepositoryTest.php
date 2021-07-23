<?php


namespace Features\Auth\Infra\Repositories;


use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\RegisterUserRepository;

class RegisterUserRepositoryTest extends TestCase
{
    private static User $dummyUser;

    /**
     * @before
     */
    public function loadUser(): void
    {
        self::$dummyUser = new User(
            userUuid: new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            email: new Email('any@email.com'),
            password: new Password(PasswordEncrypt::hash('anysecret1234')),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        );
    }

    public function testShouldStoreAUser(): void
    {
        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $repository = new RegisterUserRepository($dataLayer);

        $repository->invoke(self::$dummyUser);

        self::assertTrue(true);
    }

    public function testShouldReturnTrueWhenEmailAlreadyExist(): void
    {
        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('hasEmailAlready')
            ->willReturn(true);

        $repository = new RegisterUserRepository($dataLayer);

        self::assertTrue($repository->hasEmailAlready(new Email('any@email.com')));
    }

    public function testShouldThrowADataLayerExceptionWhenIsImpossibleRegisterAUser(): void
    {
        self::expectException(RegisterUserDataLayerException::class);

        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('invoke')
            ->will(self::throwException(new Exception()));

        $repository = new RegisterUserRepository($dataLayer);

        $repository->invoke(self::$dummyUser);
    }

    public function testShouldThrowADataLayerExceptionWhenIsImpossibleCheckAUserEmail(): void
    {
        self::expectException(RegisterUserDataLayerException::class);

        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('hasEmailAlready')
            ->will(self::throwException(new Exception()));

        $repository = new RegisterUserRepository($dataLayer);

        $repository->hasEmailAlready(new Email('any@email.com'));
    }
}