<?php


namespace Features\VotingSection\Domain\UseCases;


use DateInterval;
use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\CreateVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\ICreateVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\CreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use RuntimeException;

class CreateVotingSectionUseCaseTest extends TestCase
{


    public function testShouldThrowARuntimeExceptionWhenIsNotPossibleCreateAVotingSection(): void
    {
        self::expectException(CreateVotingSectionException::class);

        $repository = self::createMock(ICreateVotingSectionRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new RuntimeException());

        $useCase = new CreateVotingSectionUseCase($repository);

        $dummyVotingSearchUUID = new VotingOptionUuid('votingOptionUuid');
        $startDate = new DateTime('now');
        $finishDate = new DateTime('tomorrow');

        $dummyVotingUUID = new VotingUuid('uuid');
        $dummyVoting = new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
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

    public function testShouldThrowACreateVotingSectionExceptionWhenTheCreatedDateIsLessThanToday(): void
    {
        self::expectException(CreateVotingSectionException::class);
        $voting = new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('yesterday'),
            new DateTime('tomorrow'),
        );

        $repository = self::createMock(ICreateVotingSectionRepository::class);
        $dummyUseCase = new CreateVotingSectionUseCase($repository);

        $dummyUseCase($voting);
    }

    public function testShouldThrowACreateVotingSectionExceptionWhenTheFinishDateIsLessThanCreatedDate(): void
    {
        self::expectExceptionMessage('The date needs be bigger than finish date.');
        $voting = new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('now'),
            new DateTime('yesterday')
        );

        $repository = self::createMock(ICreateVotingSectionRepository::class);
        $dummyUseCase = new CreateVotingSectionUseCase($repository);

        $dummyUseCase($voting);
    }

    public function testShouldThrowACreateVotingSectionExceptionWhenTheFinishDateIsLessThanCreatedDateInHours(): void
    {
        self::expectExceptionMessage('The created date needs be bigger than finish date at least 1 hour.');
        $startDate = new DateTime('now');
        $finishDate = (new DateTime('now'))->add(new DateInterval('PT30M'));;

        $voting = new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            new VotingUuid('uuid'),
            new Subject('Subject'),
            $startDate,
            $finishDate,
        );

        $repository = self::createMock(ICreateVotingSectionRepository::class);
        $dummyUseCase = new CreateVotingSectionUseCase($repository);

        $dummyUseCase($voting);
    }

}
