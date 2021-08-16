<?php

namespace Features\Vote\Domain\UseCases;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\VoteResultException;
use Rodri\VotingApp\Features\Vote\Domain\Repositories\IVoteResultRepository;
use Rodri\VotingApp\Features\Vote\Domain\UseCases\VoteResultUseCase;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

class VoteResultUseCaseTest extends TestCase
{
    public function testShouldReturnAVoteInstanceWithVoteResults(): void
    {
        $repository = self::createMock(IVoteResultRepository::class);
        $repository->method('__invoke')
            ->willReturn(new Vote());

        $useCase = new VoteResultUseCase($repository);

        self::assertInstanceOf(Vote::class, $useCase(new VotingUuid('98de28ef-b312-49b9-9071-3d6d145a2edb')));
    }

    public function testShouldThrowAVoteResultExceptionWhenIsNotPossibleReturnTheResults(): void
    {
        self::expectException(VoteResultException::class);
        $repository = self::createMock(IVoteResultRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new VoteResultUseCase($repository);
        $useCase(new VotingUuid('98de28ef-b312-49b9-9071-3d6d145a2edb'));

    }
}
