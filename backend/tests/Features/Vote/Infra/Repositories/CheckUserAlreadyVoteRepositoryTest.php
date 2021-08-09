<?php

namespace Features\Vote\Infra\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\ICheckUserAlreadyVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\CheckUserAlreadyVoteRepositoryException;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\CheckUserAlreadyVoteRepository;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class CheckUserAlreadyVoteRepositoryTest extends TestCase
{
    public function testShouldTrowCheckUserAlreadyVoteRepositoryExceptionWhenIsNotPossibleCheckOne(): void
    {
        self::expectException(CheckUserAlreadyVoteRepositoryException::class);

        $dataLayer = self::createMock(ICheckUserAlreadyVoteDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new \Exception());

        $repository = new CheckUserAlreadyVoteRepository($dataLayer);
        $repository(new UserUuid('any'), new VotingUuid('any'));
    }

}
