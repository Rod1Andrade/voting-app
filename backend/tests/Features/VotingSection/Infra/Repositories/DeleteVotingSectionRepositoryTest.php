<?php

namespace Features\VotingSection\Infra\Repositories;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IDeleteVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\DeleteVotingSectionRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\DeleteVotingSectionRepository;

class DeleteVotingSectionRepositoryTest extends TestCase
{

    public function testShouldThrowADeleteVotingSectionRepositoryExceptionWhenIsNotPossibleDeleteOne(): void
    {
        self::expectException(DeleteVotingSectionRepositoryException::class);

        $dataLayer = self::createMock(IDeleteVotingSectionDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new DeleteVotingSectionRepository($dataLayer);

        $repository(new VotingUuid('any'), new UserUuid('any'));
    }
}