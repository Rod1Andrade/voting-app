<?php


namespace Features\VotingSection\Domain\Entities;


use DateInterval;
use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
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
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
            new VotingUuid('uuid'),
            new Subject('Subject'),
            new DateTime('now'),
            new DateTime('tomorrow'),
        );

        self::assertTrue(true);
    }

    public function testShouldSetTheFinishDateIfIsBiggerCreatedDate(): void
    {

        $startDate = new DateTime('now');
        $finishDate = new DateTime('tomorrow');

        new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
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

        self::assertInstanceOf(
            VotingOption::class,
            $dummyVoting->getVotingOption($dummyVotingSearchUUID),
            'Search a Voting Option by your id'
        );
    }

    public function testShouldThrowAInvalidArgumentExceptionWhenInstantiateAVotingWithNotInstanceOfVotingOption(): void
    {
        self::expectExceptionMessage('The array of voting options needs be instance of Voting Option');

        $startDate = new DateTime('now');
        $finishDate = new DateTime('tomorrow');

        new Voting(
            new UserUuid('a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'),
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