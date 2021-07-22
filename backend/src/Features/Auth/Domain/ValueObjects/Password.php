<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IPasswordEncrypt;

/**
 * Value Object Password
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 */
class Password
{
    /**
     * Email constructor.
     * @param string $value
     * @param IPasswordEncrypt $passwordEncrypt
     */
    public function __construct(
        private string $value,
        private IPasswordEncrypt $passwordEncrypt
    )
    {
        $this->setValue($value);
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
        $this->value = $this->passwordEncrypt->hash($value);
    }

    public function check(string $value): bool
    {
        return $this->passwordEncrypt->check($this->value, $value);
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