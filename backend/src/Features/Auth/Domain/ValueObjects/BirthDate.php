<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use DateTime;
use DateTimeInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Value Object BirthDate
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class BirthDate
{
    /**
     * Email constructor.
     * @param DateTime $value
     */
    public function __construct(
        private DateTime $value,
    )
    {
    }

    /**
     * @return DateTime
     */
    public function getValue(): DateTime
    {
        return $this->value;
    }

    /**
     * @param DateTime $value
     */
    public function setValue(DateTime $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue()->format(DateTimeInterface::ISO8601);
    }
}