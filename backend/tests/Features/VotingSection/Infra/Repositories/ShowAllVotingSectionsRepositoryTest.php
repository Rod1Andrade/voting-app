<?php

namespace Features\VotingSection\Infra\Repositories;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowAllVotingSectionsDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\ShowAllVotingSectionRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowAllVotingSectionsRepository;

class ShowAllVotingSectionsRepositoryTest extends TestCase
{
    public function shouldReturnAlistOfVotingSections()
    {

        $dataLayer = self::createMock(IShowAllVotingSectionsDataLayer::class);
        $dataLayer->method('__invoke')
            ->willReturn([]);

        $repository = new ShowAllVotingSectionsRepository($dataLayer);
        self::assertIsArray($repository(0, 10));
    }

    public function testShouldThrowAShowAllVotingSectionRepositoryExceptionWhenIsNotPossibleGetAll(): void
    {

        self::expectException(ShowAllVotingSectionRepositoryException::class);

        $dataLayer = self::createMock(IShowAllVotingSectionsDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new ShowAllVotingSectionsRepository($dataLayer);
        $repository(0, 10);
    }
}