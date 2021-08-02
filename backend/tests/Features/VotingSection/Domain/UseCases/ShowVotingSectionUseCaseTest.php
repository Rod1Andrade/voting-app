<?php

namespace Features\VotingSection\Domain\UseCases;

use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class ShowVotingSectionUseCaseTest extends TestCase
{

    public function testShouldReturnAVotingSection(): void
    {
        $repository = self::createMock(IShowVotingSectionRepository::class);
        $repository->method('__invoke')
            ->willReturn(new Voting(
                votingUuid: new VotingUuid('any'),
                startDate:new DateTime('now'),
                finishDate: new DateTime('tomorrow')
            ));

        $useCase = new ShowVotingSectionUseCase($repository);

        self::assertInstanceOf(Voting::class, $useCase(new VotingUuid('any')));
    }
    
}