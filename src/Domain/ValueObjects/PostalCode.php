<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class PostalCode
{
    private int $postalCode;

    private function __construct(int $postalCode)
    {
        Assert::range($postalCode, 1000, 9999, 'Postal code must be 4 digits and between 1000-9999');

        $this->postalCode = $postalCode;
    }

    public static function fromInt(int $postalCode): self
    {
        return new self($postalCode);
    }

    public function toInt(): int
    {
        return $this->postalCode;
    }

    public function equals(self $other): bool
    {
        return $this->postalCode === $other->postalCode;
    }
}
