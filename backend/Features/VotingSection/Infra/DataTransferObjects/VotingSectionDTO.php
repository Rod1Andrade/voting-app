<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects;

use DateTime;
use DateTimeInterface;
use Exception;
use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Factories\VotingFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use stdClass;

/**
 * Data Transfer Object - VotingSectionDTO
 * @package Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects
 */
class VotingSectionDTO
{
    private array $votingOptions;

    private function __construct(
        private ?string $userUuid = null,
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
     * @return VotingSectionDTO
     */
    public static function createVotingDTOFromVoting(Voting $voting): VotingSectionDTO
    {
        return new VotingSectionDTO(
            $voting->getUserUuid()->getValue(),
            $voting->getVotingUuid()->getValue(),
            $voting->getSubject()->getValue(),
            $voting->getStartDate()->format(DateTimeInterface::ISO8601),
            $voting->getFinishDate()->format(DateTimeInterface::ISO8601),
            $voting->getListOfVotingOptions()
        );
    }

    /**
     * @param stdClass $voting
     * @return VotingSectionDTO
     */
    public static function createVotingDTOfromStdClass(stdClass $voting): VotingSectionDTO
    {
        return new VotingSectionDTO(
            userUuid: $voting->userUuid ?? $voting->user_id ?? null,
            votingUuid: $voting->votingUuid ?? $voting->voting_uuid ?? null,
            subject: $voting->subject ?? null,
            startDate: $voting->startDate ?? $voting->start_date ?? null,
            finishDate: $voting->finishDate ?? $voting->finish_date ?? null,
            votingOptions: $voting->votingOptions ?? []
        );
    }

    /**
     * Create instance of Voting Entity mas by voting DTO
     * @param VotingSectionDTO|null $votingDTO
     * @return Voting|null
     * @throws Exception
     */
    public static function createVotingFromVotingDTO(?VotingSectionDTO $votingDTO): ?Voting
    {
        if (empty($votingDTO)) return null;

        return VotingFactory::create(
            userUuid: $votingDTO->getUserUuid(),
            subject: $votingDTO->getSubject(),
            startDate: new DateTime($votingDTO->getStartDate()),
            finishDate: new DateTime($votingDTO->getFinishDate()),
            votingOptions: array_map(function ($value) {

                if ($value instanceof VotingOptionDTO) {
                    return new VotingOption(
                        votingOptionUuid: new VotingOptionUuid($value->getVotingOptionUuid()),
                        title: new Title($value->getTitle())
                    );
                }

                return null;
            }, $votingDTO->getVotingOptions()),
            uuid: $votingDTO->getVotingUuid(),
        );
    }

    /**
     * Parse to assoc array, normally used with json_encode
     * @param Voting|null $voting
     * @return array
     */
    public static function parserVotingToAssocArray(?Voting $voting): array
    {
        if (empty($voting))
            return [];

        return [
            'id' => $voting->getVotingUuid()->getValue(),
            'subject' => $voting->getSubject()->getValue(),
            'startDate' => $voting->getStartDate()->format(DateTimeInterface::ISO8601),
            'finishDate' => $voting->getFinishDate()->format(DateTimeInterface::ISO8601),
            'votingOptions' => array_map(function ($value) {
                if ($value instanceof VotingOption) {
                    return [
                        'id' => $value->getVotingOptionUuid()->getValue(),
                        'title' => $value->getTitle()->getValue()
                    ];
                }

                return null;
            }, $voting->getListOfVotingOptions())
        ];
    }

    /**
     * Parse to assoc array, normally used with json_encode
     * @param VotingSectionDTO|null $votingSectionDTO
     * @return array
     */
    #[Pure] public static function parserVotingSectionDTOToAssocArray(?VotingSectionDTO $votingSectionDTO): array
    {
        if (empty($votingSectionDTO))
            return [];

        return [
            'id' => $votingSectionDTO->getVotingUuid(),
            'subject' => $votingSectionDTO->getSubject(),
            'startDate' => $votingSectionDTO->getStartDate(),
            'finishDate' => $votingSectionDTO->getFinishDate(),
        ];
    }

    /**
     * Parse a list of Voting Sections DTO to assoc array, normally used with json_encode
     * @param array $votingSectionsDTO
     * @return mixed
     */
    public static function transformAListOfVotingSectionDTOToAssocArray(array $votingSectionsDTO): array
    {
        return array_map(function ($value) {
            return self::parserVotingSectionDTOToAssocArray($value);
        }, $votingSectionsDTO);
    }

    /**
     * @return string|null
     */
    public function getUserUuid(): ?string
    {
        return $this->userUuid;
    }

    /**
     * @param string|null $userUuid
     */
    public function setUserUuid(?string $userUuid): void
    {
        $this->userUuid = $userUuid;
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

            } else if ($votingOption instanceof VotingOptionDTO) {
                $this->votingOptions[] = $votingOption;
            }
        }
    }
}
