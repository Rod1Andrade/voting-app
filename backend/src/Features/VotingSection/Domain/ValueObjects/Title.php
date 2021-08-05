<?php


namespace Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects;


use JetBrains\PhpStorm\Pure;

class Title
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
