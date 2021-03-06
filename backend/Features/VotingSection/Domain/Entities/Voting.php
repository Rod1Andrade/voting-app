<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\Entities;

use DateTime;
use InvalidArgumentException;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Entity Voting
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Entity
 * @author Rodrigo Andrade
 */
class Voting
{
    private array $votingOptions;

    public function __construct(
        private ?UserUuid   $userUuid = null,
        private ?VotingUuid $votingUuid = null,
        private ?Subject    $subject = null,
        private ?DateTime   $startDate = null,
        private ?DateTime   $finishDate = null,
        array               $votingOptions = []
    )
    {

        $this->addListOfVotingOptions($votingOptions);
    }

    /**
     * @return array
     */
    public function getVotingOptions(): array
    {
        return $this->votingOptions;
    }

    /**
     * @param array $votingOptions
     */
    public function setVotingOptions(array $votingOptions): void
    {
        $this->votingOptions = $votingOptions;
    }

    /**
     * @return UserUuid|null
     */
    public function getUserUuid(): ?UserUuid
    {
        return $this->userUuid;
    }

    /**
     * @param UserUuid|null $userUuid
     */
    public function setUserUuid(?UserUuid $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return Subject|null
     * @codeCoverageIgnore
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject|null $subject
     * @codeCoverageIgnore
     */
    public function setSubject(?Subject $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return VotingUuid|null
     * @codeCoverageIgnore
     */
    public function getVotingUuid(): ?VotingUuid
    {
        return $this->votingUuid;
    }

    /**
     * @param VotingUuid|null $votingUuid
     * @codeCoverageIgnore
     */
    public function setVotingUuid(?VotingUuid $votingUuid): void
    {
        $this->votingUuid = $votingUuid;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getFinishDate(): DateTime
    {
        return $this->finishDate;
    }

    /**
     * @param DateTime $finishDate
     */
    public function setFinishDate(DateTime $finishDate): void
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @param VotingOption $votingOption
     * @codeCoverageIgnore
     */
    public function addVotingOption(VotingOption $votingOption): void
    {
        $this->votingOptions[] = $votingOption;
    }

    /**
     * Get all voting options defined to this Voting.
     * @return array
     * @codeCoverageIgnore
     */
    public function getListOfVotingOptions(): array
    {
        return $this->votingOptions;
    }

    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @return VotingOption|null
     */
    public function getVotingOption(VotingOptionUuid $votingOptionUuid): ?VotingOption
    {
        $votingOption = array_filter($this->votingOptions, function (VotingOption $value) use ($votingOptionUuid) {
            return $value->getVotingOptionUuid()->compare($votingOptionUuid);
        });

        return empty($votingOption) ? null : $votingOption[0];
    }

    /**
     * @param array $votingOptions
     */
    private function addListOfVotingOptions(array $votingOptions): void
    {
        foreach ($votingOptions as $option) {
            if (!($option instanceof VotingOption)) {
                throw new InvalidArgumentException('The array of voting options needs be instance of Voting Option');
            }

            $this->votingOptions[] = $option;
        }
    }
}
