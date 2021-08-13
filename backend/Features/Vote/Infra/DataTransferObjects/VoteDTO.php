<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;

/**
 * DTO - Vote DTO
 * @author Rodrigo Andrade
 */
class VoteDTO
{
    private function __construct(
        private ?string $userUuid = null,
        private ?string $votingOptionUuid = null,
        private ?string $votingUuid = null,
        private ?string $voteAt = null,
        private ?string $subject = null,
    )
    {
    }

    public static function createVoteDTOFromVote(?Vote $vote): ?VoteDTO
    {
        if (empty($vote)) return null;

        return new VoteDTO(
            userUuid: $vote->getUserUuid()->getValue() ?? null,
            votingOptionUuid: $vote->getVotingOptionUuid()?->getValue() ?? null,
            votingUuid: $vote->getVotingUuid()?->getValue() ?? null,
            voteAt: $vote->getVoteAt()?->format(\DateTimeInterface::ISO8601) ?? null,
            subject: $vote->getSubject() ?? null
        );
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
    public function getVoteAt(): ?string
    {
        return $this->voteAt;
    }

    /**
     * @param string|null $voteAt
     */
    public function setVoteAt(?string $voteAt): void
    {
        $this->voteAt = $voteAt;
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
}
