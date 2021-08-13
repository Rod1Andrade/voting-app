<?php


namespace Rodri\VotingApp\Features\Vote\Domain\ValueObjects;

use JetBrains\PhpStorm\Pure;

/**
 * Value Object VotingUuid
 * @package Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class VotingUuid
{
    public function __construct(
        private string $value
    )
    {
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @codeCoverageIgnore
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * Compare to voting uuid
     * @param VotingUuid $votingUuid
     * @return bool
     */
    #[Pure] public function compare(VotingUuid $votingUuid): bool
    {
        return $this->getValue() === $votingUuid->getValue();
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    #[Pure] public function __toString(): string
    {
        return $this->getValue();
    }
}
