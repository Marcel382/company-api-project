<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use RuntimeException;
use Domain\SimpleUuidInterface;

final class CompanyCouldNotBeFound extends RuntimeException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function withId(SimpleUuidInterface $companyId): self
    {
        return new self(
            sprintf('Company with id: "%s" could not be found.', $companyId->toString()),
        );
    }
}
