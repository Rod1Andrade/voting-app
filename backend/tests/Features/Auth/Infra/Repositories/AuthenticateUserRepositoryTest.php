<?php


namespace Features\Auth\Infra\Repositories;


use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\Entities\User;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;
use Rodri\VotingApp\Features\Auth\Infra\DataLayer\IAuthenticateUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\AuthenticateUserDataLayerException;
use Rodri\VotingApp\Features\Auth\Infra\Repositories\AuthenticateUserRepository;

class AuthenticateUserRepositoryTest extends TestCase
{
    public function testShouldReturnAUser(): void
    {

        $dummyUuid = '8c2401ca-aba5-4a43-a651-57e8ed58d9cb';
        $dummyEmail = new Email('any@email.com');
        $dummyPass = new Password('anysecret1234');

        $dummyUser = new User();
        $dummyUser->setUserUuid(new UserUuid($dummyUuid));
        $dummyUser->setEmail($dummyEmail);
        $dummyUser->setPassword(new Password(PasswordEncrypt::hash($dummyPass)));

        $dataLayer = self::createMock(IAuthenticateUserDataLayer::class);
        $dataLayer->method('__invoke')
            ->willReturn(UserDTO::factoryUserDTOfromUser($dummyUser));

        $repository = new AuthenticateUserRepository($dataLayer);
        $user = $repository($dummyEmail);
        self::assertEquals('any@email.com', $user->getEmail()->getValue());
    }

    public function testShouldThrowAAuthenticateUserDataLayerException(): void
    {
        self::expectException(AuthenticateUserDataLayerException::class);
        $dummyEmail = new Email('any@email.com');
        $dataLayer = self::createMock(IAuthenticateUserDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new AuthenticateUserRepository($dataLayer);
        $repository($dummyEmail);
    }
}