<?php

namespace Features\VotingSection\Infra\Repositories;

use Exception;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\DeleteVotingOptionRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\DeleteVotingOptionRepository;
use PHPUnit\Framework\TestCase;

class DeleteVotingOptionRepositoryTest extends TestCase
{

    public function testShouldThowADeleteVotingRepositoryExceptionWhenItsNotPossibleDeleteOne(): void
    {
        self::expectException(DeleteVotingOptionRepositoryException::class);
        
        $dataLayer = self::createMock(IDeleteVotingOptionDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new DeleteVotingOptionRepository($dataLayer);

        $repository(new VotingOptionUuid('any'), new UserUuid('any'));
    }
}
