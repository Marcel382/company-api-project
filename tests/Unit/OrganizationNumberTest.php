<?php

use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;
use Domain\ValueObjects\OrganizationNumber;

class OrganizationNumberTest extends TestCase
{
    public function test_an_organization_number_must_not_have_less_than_8_digits()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Organization number can only be 8 numbers long');

        OrganizationNumber::fromInt(123456);
    }

    public function test_an_organization_number_must_have_more_than_8_digits()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Organization number can only be 8 numbers long');

        OrganizationNumber::fromInt(12345678910);
    }

    public function test_an_organization_number_with_8_digits_can_be_created()
    {
        $organizationNumber = OrganizationNumber::fromInt(12345678);

        $this->assertSame(12345678, $organizationNumber->toInt());
    }
}
