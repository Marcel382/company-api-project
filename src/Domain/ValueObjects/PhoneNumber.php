<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class PhoneNumber
{
    private string $phoneNumber;

    private function __construct(string $phoneNumber)
    {
        Assert::notEmpty($phoneNumber, 'Phone number cannot be empty');

        $this->phoneNumber = $phoneNumber;
    }

    public static function fromString(string $phoneNumber): self
    {
        return new self($phoneNumber);
    }

    public function toString(): string
    {
        return $this->phoneNumber;
    }

    public function equals(self $other): bool
    {
        return $this->phoneNumber === $other->phoneNumber;
    }
}
