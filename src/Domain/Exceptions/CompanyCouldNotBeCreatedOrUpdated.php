<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use Domain\ValueObjects\OrganizationNumber;
use RuntimeException;

final class CompanyCouldNotBeCreatedOrUpdated extends RuntimeException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function forAlreadyExistingOrganizationNumber(OrganizationNumber $organizationNumber): self
    {
        return new self(
            sprintf('Company could not be created. Company with Organization Number: "%s" already exists.', $organizationNumber->toInt()),
        );
    }
}
