<?php


namespace Features\Auth\External\DataLayer;


use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\External\DataLayer\AuthenticateUserDataLayer;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Rodri\VotingApp\Features\Auth\Infra\Exceptions\AuthenticateUserDataLayerException;

class AuthenticateUserDataLayerTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testShouldReturnAUserDTO(): void
    {
        $dataLayer = new AuthenticateUserDataLayer(
            MemorySqliteConnection::getConnection(),
            'tb_user'
        );

        self::assertInstanceOf(UserDTO::class, $dataLayer(new Email('any@email.com')));
    }

    /**
     * @throws \Exception
     */
    public function testShouldThrowAAuthenticateUserDataLayerExceptionWhenEmailNotMatch(): void
    {
        self::expectException(AuthenticateUserDataLayerException::class);
        $dataLayer = new AuthenticateUserDataLayer(
            MemorySqliteConnection::getConnection(),
            'tb_user'
        );

        $dataLayer(new Email('anys@email.com'));
    }
}