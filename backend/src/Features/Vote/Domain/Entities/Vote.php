<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Entities;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

/**
 * Entity - Vote
 * @author Rodrigo Andrade
 */
class Vote
{
    /**
     * @param UserUuid|null $userUuid
     * @param VotingUuid|null $votingUuid
     * @param Subject|null $subject
     * @param array|null $voteResults
     */
    public function __construct(
        private ?UserUuid   $userUuid = null,
        private ?VotingUuid $votingUuid = null,
        private ?Subject    $subject = null,
        private ?array      $voteResults = null
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
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject|null $subject
     */
    public function setSubject(?Subject $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return array|null
     */
    public function getVoteResults(): ?array
    {
        return $this->voteResults;
    }

    /**
     * @param array|null $voteResults
     */
    public function setVoteResults(?array $voteResults): void
    {
        $this->voteResults = $voteResults;
    }
}
