<?php

namespace Features\Vote\Domain\UseCases;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\UserVoteException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IUserVoteRepository;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\UserVoteUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class UserVoteUseCaseTest extends TestCase
{
    public function testShouldThrowAUserVoteExceptionWhenIsNotPossibleAUserVote(): void
    {
        self::expectException(UserVoteException::class);

        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($repository);
        $useCase(
            new UserUuid('any'),
            new VotingOptionUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0')
        );
    }

    public function testShouldThrowAUserVoteExceptionWhenHasVotingOptionUuidInvalid(): void
    {
        self::expectException(UserVoteException::class);

        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($repository);
        $useCase(
            new UserUuid('any'),
            new VotingOptionUuid('any'),
            new VotingUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0')
        );
    }

    public function testShouldThrowAUserVoteExceptionWhenHasVotingUuidInvalid(): void
    {
        self::expectException(UserVoteException::class);

        $repository = self::createMock(IUserVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new UserVoteUseCase($repository);

        $useCase(
            new UserUuid('any'),
            new VotingOptionUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
            new VotingUuid('abt')
        );
    }
}
