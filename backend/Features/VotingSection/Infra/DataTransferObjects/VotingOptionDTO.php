<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use stdClass;

/**
 * Class VotingOptionDTO
 * @package Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects
 * @author Rodrigo Andrade
 */
class VotingOptionDTO
{
    private function __construct(
        private ?string $votingOptionUuid,
        private ?string $votingUuid,
        private ?string $title
    )
    {
    }

    /**
     * Instance of Voting Option DTO made by Voting Option entity.
     * @param VotingOption $votingOption
     * @return VotingOptionDTO
     */
    #[Pure] public static function createVotingOptionDTOFromVotingOption(VotingOption $votingOption): VotingOptionDTO
    {
        return new VotingOptionDTO(
            $votingOption->getVotingOptionUuid()?->getValue() ?? null,
            $votingOption->getVotingUuid()?->getValue() ?? null,
            $votingOption->getTitle()?->getValue() ?? null
        );
    }

    /**
     * @param stdClass $votingOption
     * @return VotingOptionDTO
     */
    #[Pure] public static function createVotingOptionDTOFromStdClass(stdClass $votingOption): VotingOptionDTO
    {
        return new VotingOptionDTO(
            votingOptionUuid: $votingOption->votingOptionUuid ?? $votingOption->voting_option_uuid ?? null,
            votingUuid: $votingOption->votingUuid ?? $votingOption->voting_uuid ?? null,
            title: $votingOption->title ?? null
        );
    }

    /**
     * @return string|null
     */
    public function getVotingOptionUuid(): ?string
    {
        return $this->votingOptionUuid;
    }

    /**
     * @param string|null $votingOptionUuid
     */
    public function setVotingOptionUuid(?string $votingOptionUuid): void
    {
        $this->votingOptionUuid = $votingOptionUuid;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }


}
