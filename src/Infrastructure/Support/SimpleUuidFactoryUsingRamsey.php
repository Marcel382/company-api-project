<?php

declare(strict_types=1);

namespace Infrastructure\Support;

use Domain\SimpleUuidFactory;
use Domain\SimpleUuidInterFace;
use Ramsey\Uuid\UuidFactory;

readonly class SimpleUuidFactoryUsingRamsey implements SimpleUuidFactory
{
    public function __construct(private UuidFactory $uuidFactory)
    {
    }

    public function make(): SimpleUuidInterFace
    {
        return new SimpleUuidUsingRamsey($this->uuidFactory->uuid4()->toString());
    }
}
