<?php

namespace Features\Vote\Domain\UseCases;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\UserVoteException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IUserVoteRepository;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\ICheckUserAlreadyVoteUseCase;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\UserVoteUseCase;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

class UserVoteUseCaseTest extends TestCase
{
    public function testShouldThrowAUserVoteExceptionWhenIsNotPossibleAUserVote(): void
    {
        self::expectException(UserVoteException::class);

        $alreadyUseCaseMock = self::createMock(ICheckUserAlreadyVoteUseCase::class);
        $alreadyUseCaseMock->method('__invoke')
            ->willReturn(false);

        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($alreadyUseCaseMock, $repository);

        $useCase(
            new UserUuid('any'),
            new VotingUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingOptionUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0')
        );
    }

    public function testShouldThrowAUserVoteExceptionWhenHasVotingOptionUuidInvalid(): void
    {
        self::expectException(UserVoteException::class);

        $alreadyUseCaseMock = self::createMock(ICheckUserAlreadyVoteUseCase::class);
        $alreadyUseCaseMock->method('__invoke')
            ->willReturn(false);


        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($alreadyUseCaseMock, $repository);
        $useCase(
            new UserUuid('any'),
            new VotingUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingOptionUuid('any')
        );
    }

    public function testShouldThrowAUserVoteExceptionWhenHasVotingUuidInvalid(): void
    {
        self::expectException(UserVoteException::class);

        $alreadyUseCaseMock = self::createMock(ICheckUserAlreadyVoteUseCase::class);
        $alreadyUseCaseMock->method('__invoke')
            ->willReturn(false);

        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($alreadyUseCaseMock, $repository);

        $useCase(
            new UserUuid('any'),
            new VotingUuid('abt'),
            new VotingOptionUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0')
        );
    }

    public function testShouldThrowAUserVoteExceptionWhenHasVotingAlreadyDoIt(): void
    {
        self::expectException(UserVoteException::class);

        $alreadyUseCaseMock = self::createMock(ICheckUserAlreadyVoteUseCase::class);
        $alreadyUseCaseMock->method('__invoke')
            ->willReturn(true);

        $repository = self::createMock(IUserVoteRepository::class);

        $useCase = new UserVoteUseCase($alreadyUseCaseMock, $repository);

        $useCase(
            new UserUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingOptionUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0')
        );
    }
}
