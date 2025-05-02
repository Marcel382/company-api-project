<?php

declare(strict_types=1);

namespace Application\Commands;

use Domain\ValueObjects\Address;
use Domain\ValueObjects\City;
use Domain\ValueObjects\Email;
use Domain\ValueObjects\Name;
use Domain\ValueObjects\OrganizationNumber;
use Domain\ValueObjects\PhoneNumber;
use Domain\ValueObjects\PostalCode;

final class CreateCompanyCommand
{
    public function __construct(
        public Name $name,
        public OrganizationNumber $organizationNumber,
        public Email $email,
        public PhoneNumber $phoneNumber,
        public Address $address,
        public City $city,
        public PostalCode $postalCode,
    )
    {
    }
}
