<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\Entities;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Entity Voting Option
 * @package Rodri\VotingApp\Features\VotingSection\Domain\Entity
 * @author Rodrigo Andrade
 */
class VotingOption
{
    public function __construct(
        private ?VotingOptionUuid $votingOptionUuid = null,
        private ?VotingUuid $votingUuid = null,
        private ?Title $title = null
    )
    {
    }

    /**
     * @return VotingOptionUuid|null
     */
    public function getVotingOptionUuid(): ?VotingOptionUuid
    {
        return $this->votingOptionUuid;
    }

    /**
     * @param VotingOptionUuid|null $votingOptionUuid
     */
    public function setVotingOptionUuid(?VotingOptionUuid $votingOptionUuid): void
    {
        $this->votingOptionUuid = $votingOptionUuid;
    }

    /**
     * @return VotingUuid|null
     */
    public function getVotingUuid(): ?VotingUuid
    {
        return $this->votingUuid;
    }

    /**
     * @param VotingUuid|null $votingUuid
     */
    public function setVotingUuid(?VotingUuid $votingUuid): void
    {
        $this->votingUuid = $votingUuid;
    }

    /**
     * @return Title|null
     */
    public function getTitle(): ?Title
    {
        return $this->title;
    }

    /**
     * @param Title|null $title
     */
    public function setTitle(?Title $title): void
    {
        $this->title = $title;
    }
}
