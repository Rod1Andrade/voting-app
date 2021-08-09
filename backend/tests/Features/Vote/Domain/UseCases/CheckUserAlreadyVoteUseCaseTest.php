<?php

namespace Features\Vote\Domain\UseCases;

use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\CheckUserAlreadyVoteException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\ICheckUserAlreadyVoteRepository;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\CheckUserAlreadyVoteUseCase;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class CheckUserAlreadyVoteUseCaseTest extends TestCase
{

    public function testShouldTrowCheckUserAlreadyVoteExceptionWhenIsNotPossibleCheckOne(): void
    {
        self::expectException(CheckUserAlreadyVoteException::class);

        $repository = self::createMock(ICheckUserAlreadyVoteRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new \Exception());

        $useCase = new CheckUserAlreadyVoteUseCase($repository);
        $useCase(new UserUuid('any'), new VotingUuid(Uuid::genUUIDv4()));
    }
    
}
