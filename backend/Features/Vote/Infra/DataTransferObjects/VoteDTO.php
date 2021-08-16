<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects;

use Rodri\VotingApp\Features\Vote\Domain\Entities\Vote;

/**
 * DTO - Vote DTO
 * @author Rodrigo Andrade
 */
class VoteDTO
{
    private ?array $voteResults;

    private function __construct(
        private ?string $votingUuid = null,
        private ?string $startDate = null,
        private ?string $finishDate = null,
        private ?string $subject = null,
        ?array          $voteResults = null
    )
    {
        $this->addListOfVoteResultDTO($voteResults);
    }

    /**
     * @param Vote|null $vote
     * @return VoteDTO|null
     */
    public static function createVoteDTOFromVote(?Vote $vote): ?VoteDTO
    {
        if (empty($vote)) return null;

        return new VoteDTO(
            votingUuid: $vote->getVotingUuid()?->getValue() ?? null,
            startDate: $vote->getStartDate()?->format(\DateTimeInterface::ISO8601) ?? null,
            finishDate: $vote->getFinishDate()?->format(\DateTimeInterface::ISO8601) ?? null,
            subject: $vote->getSubject() ?? null,
            voteResults: array_map(function($value) {
                return VoteResultDTO::createVoteResultDTOFromVoteResult($value);
            }, $vote->getVoteResults())
        );
    }

    /**
     * @param VoteDTO $param
     */
    public static function createVoteFromVoteDTO(VoteDTO $param)
    {
    }

    /**
     * Add a list of vote result DTO from $voteResults reference.
     *
     * @param array|null $voteResults
     */
    private function addListOfVoteResultDTO(?array $voteResults)
    {
        if(!empty($voteResults)) return;

        foreach ($voteResults as $voteResult) {
            if($voteResult instanceof VoteResultDTO) {
                $this->voteResults[] = $voteResult;
            }
        }
    }

    /**
     * @return array|null
     */
    public function getVoteResults(): ?array
    {
        return $this->voteResults;
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
     * @param string|null $finishDate
     */
    public function setFinishDate(?string $finishDate): void
    {
        $this->finishDate = $finishDate;
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
