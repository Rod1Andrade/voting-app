<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\Factories;

use DateTime;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Voting Factory
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Factories
 * @author Rodrigo Andrade
 */
class VotingFactory implements IVotingFactory
{

    public static function create(string $userUuid, string $subject, DateTime $startDate, DateTime $finishDate, array $votingOptions, ?string $uuid = null): Voting
    {

        $voting = new Voting(
            userUuid: new UserUuid($userUuid),
            votingUuid: !empty($uuid) ? new VotingUuid($uuid) : new VotingUuid(Uuid::genUUIDv4()),
            subject: new Subject($subject),
            startDate: $startDate,
            finishDate: $finishDate
        );

        foreach ($votingOptions as $votingOption) {
            if ($votingOption instanceof VotingOption) {
                $votingOption->setVotingUuid($voting->getVotingUuid());

                if (empty($votingOption->getVotingOptionUuid()) || empty($votingOption->getVotingOptionUuid()->getValue()))
                    $votingOption->setVotingOptionUuid(new VotingOptionUuid(Uuid::genUUIDv4()));

                $voting->addVotingOption($votingOption);
            }
        }

        return $voting;
    }
}