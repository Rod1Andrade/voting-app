<?php

namespace Features\VotingSection\Domain\UseCases;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowAllVotingSectionsRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowAllVotingSectionsUseCase;

class ShowAllVotingSectionsUseCaseTest extends TestCase
{

    public function testShouldReturnAListOfAllVotingSections(): void
    {

        $repository = self::createMock(IShowAllVotingSectionsRepository::class);
        $repository->method('__invoke')
            ->willReturn([]);
        $useCase = new ShowAllVotingSectionsUseCase($repository);

        self::assertIsArray($useCase());
    }

}