<?php


namespace Features\Auth\Domain\UseCases;


use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\AuthenticateUserException;
use Rodri\VotingApp\Features\Auth\Domain\Repositories\IAuthenticateUserRepository;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\AuthenticateUserUseCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;

class AuthenticateUserUseCaseTest extends TestCase
{

    public function testShouldReturnAUserUuidIfEmailAndPasswordAreOkay()
    {
        $dummyUuid = '8c2401ca-aba5-4a43-a651-57e8ed58d9cb';
        $dummyEmail = new Email('any@email.com');
        $dummyPass = new Password('anysecret1234');

        $dummyUser = new User();
        $dummyUser->setUserUuid(new UserUuid($dummyUuid));
        $dummyUser->setEmail($dummyEmail);
        $dummyUser->setPassword(new Password(PasswordEncrypt::hash($dummyPass)));


        $repositoryMock = self::createMock(IAuthenticateUserRepository::class);
        $repositoryMock->method('__invoke')
            ->willReturn($dummyUser);

        $useCase = new AuthenticateUserUseCase($repositoryMock);
        self::assertEquals($dummyUuid, $useCase($dummyEmail, $dummyPass)->getValue());
    }

    public function testShouldThrowAAuthenticateUserExceptionWhenIsNotPossibleAuth()
    {
        self::expectException(AuthenticateUserException::class);
        $dummyEmail = new Email('any@email.com');
        $repositoryMock = self::createMock(IAuthenticateUserRepository::class);
        $repositoryMock->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new AuthenticateUserUseCase($repositoryMock);
        $useCase($dummyEmail, new Password(''));
    }
}