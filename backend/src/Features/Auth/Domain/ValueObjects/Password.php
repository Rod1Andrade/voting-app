<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;

/**
 * Value Object Password
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 */
class Password
{
    /**
     * Email constructor.
     * @param string $value
     */
    public function __construct(
        private string $value,
    )
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        // TODO: hash composition to encrypt password
        $this->value = $value;
    }

    /**
     * @return string
     */
    #[Pure] public function __toString(): string
    {
        return $this->getValue();
    }
}