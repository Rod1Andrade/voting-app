<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Entities;

use DateTime;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Entity - Vote
 * @author Rodrigo Andrade
 */
class Vote
{
    /**
     * @param UserUuid|null $userUuid
     * @param VotingOptionUuid|null $votingOptionUuid
     * @param VotingUuid|null $votingUuid
     * @param DateTime|null $voteAt
     */
    public function __construct(
        private ?UserUuid         $userUuid = null,
        private ?VotingUuid       $votingUuid = null,
        private ?VotingOptionUuid $votingOptionUuid = null,
        private ?DateTime         $voteAt = null
    )
    {
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
     * @return DateTime|null
     */
    public function getVoteAt(): ?DateTime
    {
        return $this->voteAt;
    }

    /**
     * @param DateTime|null $voteAt
     */
    public function setVoteAt(?DateTime $voteAt): void
    {
        $this->voteAt = $voteAt;
    }
}
