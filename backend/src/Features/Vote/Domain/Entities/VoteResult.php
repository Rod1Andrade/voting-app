<?php

namespace Rodri\VotingApp\Features\Vote\Domain\Entities;

use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Entity - Vote Result
 * @author Rodrigo Andrade
 */
class VoteResult
{
    public function __construct(
        private ?VotingOptionUuid $votingOptionUuid = null,
        private ?Title            $title = null,
        private ?int              $quantity = null
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
