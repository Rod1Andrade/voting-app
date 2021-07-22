<?php


namespace Rodri\VotingApp\Features\Auth\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\Features\Auth\Domain\Adapters\IUuid;

/**
 * Value Object UserUuid
 * @package Rodri\VotingApp\Features\Auth\Domain\ValueObjects
 * @author Rodrigo Andrade
 */
class UserUuid
{

    private string $value;

    /**
     * Email constructor.
     * @param IUuid $uuid
     */
    public function __construct(
        IUuid $uuid,
    )
    {
        $this->setValue($uuid);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param IUuid $uuid
     */
    public function setValue(IUuid $uuid): void
    {
        $this->value = $uuid->genUUIDv4();
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