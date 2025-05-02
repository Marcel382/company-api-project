<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class Address
{
    private string $address;

    private function __construct(string $address)
    {
        Assert::notEmpty($address, 'Address cannot be empty');

        $this->address = $address;
    }

    public static function fromString(string $address): self
    {
        return new self(ucfirst($address));
    }

    public function toString(): string
    {
        return $this->address;
    }

    public function equals(self $other): bool
    {
        return $this->address === $other->address;
    }
}
