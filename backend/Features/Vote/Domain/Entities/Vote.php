<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Entities;

use DateTime;
use InvalidArgumentException;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\Subject;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Entity - Vote
 * @author Rodrigo Andrade
 */
class Vote
{
    private ?array $voteResults;

    /**
     * @param VotingUuid|null $votingUuid
     * @param DateTime|null $startDate
     * @param DateTime|null $finishDate
     * @param Subject|null $subject
     * @param array|null $voteResults
     */
    public function __construct(
        private ?VotingUuid $votingUuid = null,
        private ?DateTime   $startDate = null,
        private ?DateTime   $finishDate = null,
        private ?Subject    $subject = null,
        ?array              $voteResults = null
    )
    {
        $this->addListOfVoteResult($voteResults);
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
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime|null $startDate
     */
    public function setStartDate(?DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime|null
     */
    public function getFinishDate(): ?DateTime
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
     * Add a list of vote results checking if is really an instance of
     * @param array|null $voteResults
     */
    private function addListOfVoteResult(?array $voteResults): void
    {
        if(empty($voteResult)) return;
        foreach ($voteResults as $voteResult) {
            if (!($voteResult instanceof VoteResult)) {
                throw new InvalidArgumentException(
                    'The array of voting results needs be instance of Vote Result'
                );
            }

            $this->voteResults[] = $voteResult;
        }
    }
}
