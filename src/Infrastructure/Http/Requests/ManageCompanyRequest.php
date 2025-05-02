<?php

declare(strict_types=1);

namespace Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Domain\ValueObjects\Name;
use Domain\ValueObjects\OrganizationNumber;
use Domain\ValueObjects\Email;
use Domain\ValueObjects\PhoneNumber;
use Domain\ValueObjects\Address;
use Domain\ValueObjects\City;
use Domain\ValueObjects\PostalCode;

final class ManageCompanyRequest extends FormRequest
{
    /** @return array<string, array> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'organization_number' => ['required', 'digits:8'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'digits:4'],
        ];
    }

    public function getName(): Name
    {
        /** @var string $name */
        $name = $this->input('name');

        return Name::fromString($name);
    }

    public function getOrganizationNumber(): OrganizationNumber
    {
        /** @var int $organizationNumber */
        $organizationNumber = $this->input('organization_number');

        return OrganizationNumber::fromInt($organizationNumber);
    }

    public function getEmail(): Email
    {
        /** @var string $email */
        $email = $this->input('email');

        return Email::fromString($email);
    }

    public function getPhoneNumber(): PhoneNumber
    {
        /** @var string $phoneNumber */
        $phoneNumber = $this->input('phone_number');

        return PhoneNumber::fromString($phoneNumber);
    }

    public function getAddress(): Address
    {
        /** @var string $addres */
        $address = $this->input('address');

        return Address::fromString($address);
    }

    public function getCity(): City
    {
        /** @var string $city */
        $city = $this->input('city');

        return City::fromString($city);
    }

    public function getPostalCode(): PostalCode
    {
        /** @var int $postalCode */
        $postalCode = $this->input('postal_code');

        return PostalCode::fromInt($postalCode);
    }
}
