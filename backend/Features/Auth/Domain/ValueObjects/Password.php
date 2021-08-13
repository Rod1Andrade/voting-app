<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\External\Adapters\PasswordEncrypt;

/**
 * Value Object Password
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 */
class Password
{
    /**
     * Password constructor.
     * @param string $value
     */
    public function __construct(
        private string $value,
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
     * Hash a password passed by argument or hash da password
     * plain in the object.
     * @param string $value
     * @return string
     * @codeCoverageIgnore
     */
    public function hash(string $value = ''): string
    {
        if(empty($value))
            return PasswordEncrypt::hash($this->value);

        return PasswordEncrypt::hash($value);
    }

    /**
     * @param string $value
     * @return bool
     * @codeCoverageIgnore
     */
    public function check(string $value): bool
    {
        return PasswordEncrypt::check($this->value, $value);
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