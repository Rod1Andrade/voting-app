<?php


namespace Features\Auth\Domain\UseCases;


use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IRegisterUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\RegisterUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\BirthDate;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;

class RegisterUserUseCaseTest extends TestCase
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

    public function testShouldCallUseCaseMethodByInvokeMethod(): void
    {
        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('hasEmailAlready')
            ->willReturn(false);

        $useCase = new RegisterUserUseCase($repository);

        $useCase(self::$dummyUser);

        self::assertTrue(true);
    }

    public function testThrowAExceptionWhenRegisterAUserFailed(): void
    {

        self::expectException(RegisterUserException::class);

        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('invoke')
            ->will(self::throwException(new Exception));

        $useCase = new RegisterUserUseCase($repository);

        $useCase(self::$dummyUser);
    }

    public function testThrowAExceptionWhenEmailAlreadyExist(): void
    {

        self::expectException(RegisterUserException::class);

        $repository = $this->createMock(IRegisterUserRepository::class);
        $repository->method('hasEmailAlready')
            ->willReturn(true);

        $useCase = new RegisterUserUseCase($repository);

        $useCase(self::$dummyUser);
    }
}