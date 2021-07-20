<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;

/**
 * Value Object UserUuid
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class UserUuid
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
        //TODO: Uuid id composition to make easy a way to create a uuid value.
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