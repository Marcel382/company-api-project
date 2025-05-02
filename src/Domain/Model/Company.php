<?php

declare(strict_types=1);

namespace Domain\Model;

use DateTimeImmutable;
use Domain\ValueObjects\Address;
use Domain\ValueObjects\City;
use Domain\ValueObjects\Email;
use Domain\ValueObjects\Name;
use Domain\ValueObjects\OrganizationNumber;
use Domain\ValueObjects\PhoneNumber;
use Domain\ValueObjects\PostalCode;
use Domain\SimpleUuidInterface;

class Company
{
    public function __construct(
        public SimpleUuidInterface $id,
        public Name $name,
        public OrganizationNumber $organizationNumber,
        public Email $email,
        public PhoneNumber $phoneNumber,
        public Address $address,
        public City $city,
        public PostalCode $postalCode,
        public DateTimeImmutable $createdAt,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name->toString(),
            'organizationNumber' => $this->organizationNumber->toInt(),
            'email' => $this->email->toString(),
            'phoneNumber' => $this->phoneNumber->toString(),
            'address' => $this->address->toString(),
            'city' => $this->city->toString(),
            'postalCode' => $this->postalCode->toInt(),
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
