<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class Name
{
    private string $name;

    private function __construct(string $name)
    {
        Assert::notEmpty($name, 'Name cannot be empty');

        $this->name = $name;
    }

    public static function fromString(string $name): self
    {
        return new self(ucfirst($name));
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function equals(self $other): bool
    {
        return $this->name === $other->name;
    }
}
