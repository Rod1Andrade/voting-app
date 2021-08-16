<?php

namespace Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects;

use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Vote\Domain\Entities\VoteResult;
use Rodri\VotingApp\Features\Vote\Domain\Factories\VoteResultFactory;
use stdClass;

/**
 * DTO - VoteResult
 * @author Rodrigo Andrade
 */
class VoteResultDTO
{
    private function __construct(
        private ?string $votingOptionUuid = null,
        private ?string $title = null,
        private ?int    $quantity = null,
    )
    {
    }

    /**
     * @param VoteResult|null $voteResult
     * @return VoteResultDTO|null
     */
    #[Pure] public static function createVoteResultDTOFromVoteResult(?VoteResult $voteResult): ?VoteResultDTO
    {
        if (empty($voteResult)) return null;

        return new VoteResultDTO(
            votingOptionUuid: $voteResult->getVotingOptionUuid()?->getValue() ?? null,
            title: $voteResult->getTitle()?->getValue() ?? null,
            quantity: $voteResult->getQuantity() ?? null,
        );
    }

    /**
     * @param VoteResultDTO|null $voteResultDTO
     * @return VoteResult|null
     */
    #[Pure] public static function createVoteResultFromVoteResultDTO(?VoteResultDTO $voteResultDTO): ?VoteResult
    {
        if (empty($voteResultDTO)) return null;

        return VoteResultFactory::create(
            votingOptionUuid: $voteResultDTO->getVotingOptionUuid(),
            title: $voteResultDTO->getTitle(),
            quantity: $voteResultDTO->getQuantity()
        );
    }

    /**
     * @param stdClass|null $voteResultStdClass
     * @return VoteResultDTO|null
     */
    public static function createVoteResultDTOFromStdClass(?stdClass $voteResultStdClass): ?VoteResultDTO
    {
        if(empty($voteResultStdClass)) return null;

        return new VoteResultDTO(
            votingOptionUuid: $voteResultStdClass->votingOptionUuid ?? $voteResultStdClass->voting_option_uuid ?? null,
            title: $voteResultStdClass->title ?? null,
            quantity: $voteResultStdClass->quantity ?? null,
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

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
