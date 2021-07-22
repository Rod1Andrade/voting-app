<?php


namespace Features\Auth\Domain\UseCases;


use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IPasswordEncrypt;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IRegisterUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\RegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

class RegisterUserUseCaseTest extends TestCase
{

    public function testShouldCallUseCaseMethodByInvokeMethod(): void
    {
        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('hasEmailAlready')
            ->willReturn(false);

        $useCase = new RegisterUserUseCase($repository);

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

        $useCase(new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any'),
            password: new Password('anysecret1234', $passwordEncryptMock),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));

        self::assertTrue(true);
    }

    public function testThrowAExceptionWhenRegisterAUserFailed(): void
    {

        self::expectException(RegisterUserException::class);

        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('invoke')
            ->will(self::throwException(new Exception));

        $useCase = new RegisterUserUseCase($repository);

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

        $useCase(new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any'),
            password: new Password('anysecret1234', $passwordEncryptMock),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));
    }

    public function testThrowAExceptionWhenEmailAlreadyExist(): void
    {

        self::expectException(RegisterUserException::class);

        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('hasEmailAlready')
            ->willReturn(true);

        $useCase = new RegisterUserUseCase($repository);

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

        $useCase(new User(
            userUuid: new UserUuid($uuidMock),
            email: new Email('any'),
            password: new Password('anysecret1234', $passwordEncryptMock),
            birthDate: new BirthDate(new DateTime('now')),
            name: 'any',
            lastname: 'any'
        ));
    }
}