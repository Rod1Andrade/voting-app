<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;

/**
 * Value Object UserUuid
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class UserUuid
{

    /**
     * User UUID constructor.
     * @param string|null $value
     */
    public function __construct(
        private ?string $value,
    )
    {
    }

    /**
     * @return string|null
     * @codeCoverageIgnore
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @codeCoverageIgnore
     */
    public function setValue(?string $value): void
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
