<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class OrganizationNumber
{
    private int $organizationNumber;

    private function __construct(int $organizationNumber)
    {
        Assert::length((string) $organizationNumber, 8, 'Organization number can only be 8 numbers long');

        $this->organizationNumber = $organizationNumber;
    }

    public static function fromInt(int $organizationNumber): self
    {
        return new self($organizationNumber);
    }

    public function toInt(): int
    {
        return $this->organizationNumber;
    }

    public function equals(self $other): bool
    {
        return $this->organizationNumber === $other->organizationNumber;
    }
}
