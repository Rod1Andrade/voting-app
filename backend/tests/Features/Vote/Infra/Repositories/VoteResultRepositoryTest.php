<?php

namespace Features\Vote\Infra\Repositories;

use Exception;
use Monolog\Test\TestCase;
use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;
use Rodri\VotingApp\Features\Vote\Domain\Factories\VoteFactory;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IVoteResultDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\VoteResultRepositoryException;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\VoteResultRepository;

class VoteResultRepositoryTest extends TestCase
{
    public function testShouldReturnAInstanceOfVote(): void
    {
        $dataLayer = self::createMock(IVoteResultDataLayer::class);
        $dataLayer->method('__invoke')
            ->willReturn(
                VoteDTO::createVoteDTOFromVote(
                    VoteFactory::create('any', '2021-08-15T00:00:00+0000', '2021-08-16T00:00:00+0000','any',[])
                )
            );

        $repository = new VoteResultRepository($dataLayer);
        self::assertInstanceOf(Vote::class, $repository(new VotingUuid('any')));
    }

    public function testShouldThrowAVoteResultRepositoryExceptionWhenIsNotPossibleGetAVote(): void
    {
        self::expectException(VoteResultRepositoryException::class);
        $dataLayer = self::createMock(IVoteResultDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new VoteResultRepository($dataLayer);
        self::assertInstanceOf(Vote::class, $repository(new VotingUuid('any')));
    }
}
