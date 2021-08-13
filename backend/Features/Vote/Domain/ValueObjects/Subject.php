<?php


namespace Rodri\VotingApp\Features\Vote\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;

/**
 * Value Object Subject
 * @package Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects
 * @author Rodrigo Andrade1
 */
class Subject
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
     * @return string
     * @codeCoverageIgnore
     */
    #[Pure] public function __toString(): string
    {
        return $this->getValue();
    }

}