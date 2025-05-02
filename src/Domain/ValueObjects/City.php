<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class City
{
    private string $city;

    private function __construct(string $city)
    {
        Assert::notEmpty($city, 'City name cannot be empty');

        $this->city = $city;
    }

    public static function fromString(string $city): self
    {
        return new self(ucfirst($city));
    }

    public function toString(): string
    {
        return $this->city;
    }

    public function equals(self $other): bool
    {
        return $this->city === $other->city;
    }
}
