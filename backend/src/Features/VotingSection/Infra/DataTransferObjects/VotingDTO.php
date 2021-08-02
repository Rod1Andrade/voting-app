<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects;

use DateTime;
use DateTimeInterface;
use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Factories\VotingFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use stdClass;

/**
 * Data Transfer Object - VotingSectionDTO
 * @package Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects
 */
class VotingDTO
{
    private array $votingOptions;

    private function __construct(
        private ?string $votingUuid = null,
        private ?string $subject = null,
        private ?string $startDate = null,
        private ?string $finishDate = null,
        array           $votingOptions = [],
    )
    {
        $this->setListOfVotingOptionDTO($votingOptions);
    }

    /**
     * Create a voting DTO from Voting Entity.
     * @param Voting $voting
     * @return VotingDTO
     */
    public static function createVotingDTOFromVoting(Voting $voting): VotingDTO
    {
        return new VotingDTO(
            $voting->getVotingUuid()->getValue(),
            $voting->getSubject()->getValue(),
            $voting->getStartDate()->format(DateTimeInterface::ISO8601),
            $voting->getFinishDate()->format(DateTimeInterface::ISO8601),
            $voting->getListOfVotingOptions()
        );
    }

    /**
     * @param stdClass $voting
     * @return VotingDTO
     */
    public static function createVotingDTOfromStdClass(stdClass $voting): VotingDTO
    {
        return new VotingDTO(
            votingUuid: $voting->votingUuid ?? null,
            subject: $voting->subject ?? null,
            startDate: $voting->startDate ?? null,
            finishDate: $voting->finishDate ?? null,
            votingOptions: $voting->votingOptions ?? []
        );
    }

    /**
     * Create instance of Voting Entity mas by voting DTO
     * @param VotingDTO $votingDTO
     * @return Voting
     * @throws Exception
     */
    public static function createVotingFromVotingDTO(VotingDTO $votingDTO): Voting
    {
        return VotingFactory::create(
            subject: $votingDTO->getSubject(),
            startDate: new DateTime($votingDTO->getStartDate()),
            finishDate: new DateTime($votingDTO->getFinishDate()),
            votingOptions: array_map(function ($value) {
                if ($value instanceof VotingOptionDTO) {
                    return new VotingOption(title: new Title($value->getTitle()));
                } else {
                    return null;
                }
            }, $votingDTO->getVotingOptions()),
            uuid: $votingDTO->getVotingUuid(),
        );
    }

    /**
     * @return string|null
     */
    public function getVotingUuid(): ?string
    {
        return $this->votingUuid;
    }

    /**
     * @param string|null $votingUuid
     */
    public function setVotingUuid(?string $votingUuid): void
    {
        $this->votingUuid = $votingUuid;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     */
    public function setSubject(?string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @param string|null $startDate
     */
    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string|null
     */
    public function getFinishDate(): ?string
    {
        return $this->finishDate;
    }

    /**
     * @param DateTime|null $finishDate
     */
    public function setFinishDate(?DateTime $finishDate): void
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @return array
     */
    public function getVotingOptions(): array
    {
        return $this->votingOptions;
    }

    /**
     * @param VotingOptionDTO $votingOptions
     */
    public function addVotingOptionDTO(VotingOptionDTO $votingOptions): void
    {
        $this->votingOptions[] = $votingOptions;
    }

    /**
     * Set the list of voting deal with String valuse or Voting Entity
     * @param array $votingOptions
     */
    private function setListOfVotingOptionDTO(array $votingOptions): void
    {
        foreach ($votingOptions as $votingOption) {
            if ($votingOption instanceof VotingOption) {

                $this->votingOptions[] = VotingOptionDTO::createVotingOptionDTOFromVotingOption($votingOption);

            } else if (is_string($votingOption)) {

                $this->votingOptions[] = VotingOptionDTO::createVotingOptionDTOFromVotingOption(
                    new VotingOption(title: new Title($votingOption))
                );

            }
        }
    }
}
