<?php

namespace Features\Vote\Infra\Repositories;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataLayers\IUserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\Infra\Exceptions\UserVoteRepositoryException;
use Rodri\VotingApp\Features\Vote\Infra\Repositories\UserVoteRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class UserVoteRepositoryTest extends TestCase
{

    public function testShouldThrowAUserVoteRepositoryExceptionWhenIsNotPossibleUseTheDataLayer(): void
    {
        self::expectException(UserVoteRepositoryException::class);
        $dataLayer = self::createMock(IUserVoteDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new UserVoteRepository($dataLayer);

        $repository(new UserUuid('any'), new VotingUuid('any'), new VotingOptionUuid('any'));
    }

}
