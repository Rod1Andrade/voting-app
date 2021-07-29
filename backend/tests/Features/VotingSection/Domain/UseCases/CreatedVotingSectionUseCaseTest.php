<?php


namespace Features\VotingSection\Domain\UseCases;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\CreateVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\ICreatedVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\CreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use RuntimeException;

class CreatedVotingSectionUseCaseTest extends TestCase
{
    public function testShouldThrowARuntimeExceptionWhenIsNotPossibleCreateAVotingSection(): void
    {
        self::expectException(CreateVotingSectionException::class);

        $repository = self::createMock(ICreatedVotingSectionRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new RuntimeException());

        $useCase = new CreateVotingSectionUseCase($repository);

        $dummyVotingSearchUUID = new VotingOptionUuid('votingOptionUuid');
        $startDate = new DateTime('2021-07-29T14:01:38+0000');
        $finishDate = new DateTime('2021-07-29T15:01:38+0000');

        $dummyVotingUUID = new VotingUuid('uuid');
        $dummyVoting = new Voting(
            $dummyVotingUUID,
            new Subject('Subject'),
            $startDate,
            $finishDate,
            [
                new VotingOption($dummyVotingSearchUUID, $dummyVotingUUID, new Title('any')),
                new VotingOption(new VotingOptionUuid('any1'), $dummyVotingUUID, new Title('Any Title 1')),
                new VotingOption(new VotingOptionUuid('any2'), $dummyVotingUUID, new Title('Any Title 2')),
            ]
        );

        $useCase($dummyVoting);
    }
}