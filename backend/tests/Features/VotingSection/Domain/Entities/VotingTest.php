<?php


namespace Features\VotingSection\Domain\Entities;


use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class VotingTest extends TestCase
{

    public function testShouldSetTheCreatedDateIfIsBiggerOrEqualsToday(): void
    {
        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('now'),
            new DateTime('tomorrow'),
        );

        self::assertTrue(true);
    }

    public function testShouldThrowAInvalidArgumentExceptionWhenTheCreatedDateIsLessThanToday(): void
    {
        self::expectException(InvalidArgumentException::class);
        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('yesterday'),
            new DateTime('tomorrow'),
        );
    }

    public function testShouldThrowAInvalidArgumentExceptionWhenTheFinishDateIsLessThanCreatedDate(): void
    {
        self::expectExceptionMessage('The date needs be bigger than finish date.');
        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('now'),
            new DateTime('yesterday'),
        );
    }

    public function testShouldThrowAInvalidArgumentExceptionWhenTheFinishDateIsLessThanCreatedDateInHours(): void
    {
        self::expectExceptionMessage('The created date needs be bigger than finish date at least 1 hour.');
        $startDate = new DateTime('2021-07-29T14:01:38+0000');
        $finishDate = new DateTime('2021-07-29T14:30:38+0000');

        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            $startDate,
            $finishDate
        );
    }

    public function testShouldSetTheFinishDateIfIsBiggerOrEqualsCreatedDate(): void
    {

        $startDate = new DateTime('2021-07-29T14:01:38+0000');
        $finishDate = new DateTime('2021-07-29T15:01:38+0000');

        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            $startDate,
            $finishDate,
        );

        self::assertTrue(true);
    }

    public function testShouldReturnAVotingOptionByYourUUID(): void
    {

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

        self::assertInstanceOf(
            VotingOption::class,
            $dummyVoting->getVotingOption($dummyVotingSearchUUID),
            'Search a Voting Option by your id'
        );
    }

    public function testShouldThrowAInvalidArgumentExceptionWhenInstantiateAVotingWithNotInstanceOfVotingOption(): void
    {
        self::expectExceptionMessage('The array of voting options needs be instance of Voting Option');

        $startDate = new DateTime('2021-07-29T14:01:38+0000');
        $finishDate = new DateTime('2021-07-29T15:01:38+0000');

        new Voting(
            new VotingUuid('uuid'),
            new Subject('Subject'),
            $startDate,
            $finishDate,
            [
               'is not voting option object'
            ]
        );
    }
}