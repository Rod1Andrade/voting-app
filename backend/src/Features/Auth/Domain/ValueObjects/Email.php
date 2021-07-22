<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\InvalidEmailException;

/**
 * Value Object Email
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class Email
{
    public const EMAIL_REGEX = '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/';

    /**
     * Email constructor.
     * @param string $value
     */
    public function __construct(
        private string $value,
    )
    {
        $this->setValue($this->value);
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
     * @throws InvalidEmailException
     */
    public function setValue(string $value): void
    {
        if (!self::isValid($value))
            throw new InvalidEmailException('Invalid email');

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        return !empty(filter_var( $value, FILTER_VALIDATE_EMAIL));
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