<?php


namespace Features\Auth\Infra\Repositories;


use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IPasswordEncrypt;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IRegisterUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\RegisterUserDataLayerException;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\RegisterUserRepository;

class RegisterUserRepositoryTest extends TestCase
{
    public function testShouldStoreAUser(): void
    {
        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $repository = new RegisterUserRepository($dataLayer);

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

        $repository->invoke(new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any'),
            password: new Password('anysecret1234', $passwordEncryptMock),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));

        self::assertTrue(true);
    }

    public function testShouldReturnTrueWhenEmailAlreadyExist(): void
    {
        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('hasEmailAlready')
            ->willReturn(true);

        $repository = new RegisterUserRepository($dataLayer);

        self::assertTrue($repository->hasEmailAlready(new Email('any')));
    }

    public function testShouldThrowADataLayerExceptionWhenIsImpossibleRegisterAUser(): void
    {
        self::expectException(RegisterUserDataLayerException::class);

        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('invoke')
            ->will(self::throwException(new Exception()));

        $repository = new RegisterUserRepository($dataLayer);

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

        $repository->invoke(new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any'),
            password: new Password('anysecret1234', $passwordEncryptMock),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));
    }

    public function testShouldThrowADataLayerExceptionWhenIsImpossibleCheckAUserEmail(): void
    {
        self::expectException(RegisterUserDataLayerException::class);

        $dataLayer = self::createMock(IRegisterUserDataLayer::class);
        $dataLayer->method('hasEmailAlready')
            ->will(self::throwException(new Exception()));

        $repository = new RegisterUserRepository($dataLayer);

        $repository->hasEmailAlready(new Email('any'));
    }
}