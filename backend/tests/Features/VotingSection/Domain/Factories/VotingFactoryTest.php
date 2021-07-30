<?php


namespace Features\VotingSection\Domain\Factories;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Factories\VotingFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class VotingFactoryTest extends TestCase
{

    private static Voting $voting;

    protected function setUp(): void
    {
        self::$voting = VotingFactory::create(
            'Any Subject',
            new DateTime('now'),
            new DateTime('tomorrow'),
            [
                new VotingOption(title: new Title('any title')),
                new VotingOption(title: new Title('any title')),
                new VotingOption(title: new Title('any title')),
            ]
        );
    }

    public function testShouldReturnAInstanceOfVotingWithVotingUUIDsDefined(): void
    {
        self::assertInstanceOf(VotingUuid::class, self::$voting->getVotingUuid());
    }

    public function testShouldReturnAllVotingOptionsWithVotingUUIDDefined(): void
    {
        foreach (self::$voting->getListOfVotingOptions() as $votingOption) {
            if($votingOption instanceof VotingOption) {
                self::assertEquals(self::$voting->getVotingUuid(), $votingOption->getVotingUuid());
                self::assertInstanceOf(VotingOptionUuid::class, $votingOption->getVotingOptionUuid());
            }
        }
    }
    
}