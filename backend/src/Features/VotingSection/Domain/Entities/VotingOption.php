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
        private VotingOptionUuid $votingOptionUuid,
        private VotingUuid $votingUuid,
        private Title $title
    )
    {
    }

    /**
     * @return VotingOptionUuid
     * @codeCoverageIgnore
     */
    public function getVotingOptionUuid(): VotingOptionUuid
    {
        return $this->votingOptionUuid;
    }

    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @codeCoverageIgnore
     */
    public function setVotingOptionUuid(VotingOptionUuid $votingOptionUuid): void
    {
        $this->votingOptionUuid = $votingOptionUuid;
    }

    /**
     * @return VotingUuid
     * @codeCoverageIgnore
     */
    public function getVotingUuid(): VotingUuid
    {
        return $this->votingUuid;
    }

    /**
     * @param VotingUuid $votingUuid
     * @codeCoverageIgnore
     */
    public function setVotingUuid(VotingUuid $votingUuid): void
    {
        $this->votingUuid = $votingUuid;
    }

    /**
     * @return Title
     * @codeCoverageIgnore
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     * @codeCoverageIgnore
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }
}
