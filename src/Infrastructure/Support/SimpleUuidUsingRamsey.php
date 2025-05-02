<?php

declare(strict_types=1);

namespace Infrastructure\Support;

use Domain\SimpleUuidInterface;

readonly class SimpleUuidUsingRamsey implements SimpleUuidInterface
{
    public function __construct(private string $uuid)
    {
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public function equals(SimpleUuidInterface $other): bool
    {
        return $this->uuid === $other->toString();
    }
}
