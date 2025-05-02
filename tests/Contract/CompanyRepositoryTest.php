<?php

namespace Tests\Contract;

use DateTimeImmutable;
use Domain\Exceptions\CompanyCouldNotBeCreatedOrUpdated;
use Domain\Model\Company;
use Domain\Model\CompanyRepository;
use Domain\ValueObjects\Address;
use Domain\ValueObjects\City;
use Domain\ValueObjects\Email;
use Domain\ValueObjects\Name;
use Domain\ValueObjects\OrganizationNumber;
use Domain\ValueObjects\PhoneNumber;
use Domain\ValueObjects\PostalCode;
use Infrastructure\Repositories\CompanyRepositoryUsesInMemory;
use Infrastructure\Support\SimpleUuidFactoryUsingRamsey;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use PHPUnit\Framework\TestCase;
use Generator;
use Ramsey\Uuid\UuidFactory;

class CompanyRepositoryTest extends TestCase
{
    /** @return Generator<int, list<CompanyRepository> */
    public static function companyRepositories(): Generator
    {
        yield [
            new CompanyRepositoryUsesInMemory(
                new SimpleUuidFactoryUsingRamsey(
                    new UuidFactory()
                )
            )
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('companyRepositories')]
    public function test_it_can_save_a_company(CompanyRepository $repository)
    {
        $this->assertCount(0, $repository->findAll());

        $repository->save($this->getTestCompany('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));

        $companies =  $repository->findAll();

        $this->assertCount(1, $companies);
        $this->assertTrue(
            (new SimpleUuidUsingRamsey('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'))
            ->equals($companies[0]->id)
        );
        $this->assertTrue(OrganizationNumber::fromInt('22334455')->equals($companies[0]->organizationNumber));
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('companyRepositories')]
    public function test_it_will_throw_an_exception_when_trying_to_save_a_company_with_an_already_existing_organization_number(CompanyRepository $repository): void
    {
        $repository->save($this->getTestCompany('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));

        $this->expectException(CompanyCouldNotBeCreatedOrUpdated::class);
        $this->expectExceptionMessage('Company could not be created. Company with Organization Number: "22334455" already exists.');

        $repository->save($this->getTestCompany('e28d6c52-9f3d-4a10-89a3-b3e7f2bba3fd'));
    }


    #[\PHPUnit\Framework\Attributes\DataProvider('companyRepositories')]
    public function test_it_can_find_a_company_by_id(CompanyRepository $repository)
    {
        $repository->save($this->getTestCompany('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));

        $company = $repository->findById(new SimpleUuidUsingRamsey('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));

        $this->assertNotNull($company);
        $this->assertTrue(
            (new SimpleUuidUsingRamsey('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'))
            ->equals($company->id)
        );
        $this->assertTrue(OrganizationNumber::fromInt('22334455')->equals($company->organizationNumber));
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('companyRepositories')]
    public function test_it_can_update_an_existing_company(CompanyRepository $repository)
    {
        $repository->save($this->getTestCompany('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));

        $company = $repository->findById(new SimpleUuidUsingRamsey('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));
        $this->assertTrue(Name::fromString('Marcels Laravel House')->equals($company->name));
        $this->assertTrue(Email::fromString('marcel2002@outlook.dk')->equals($company->email));

        $company->name = Name::fromString('Marcels Symfony House');
        $company->email = Email::fromString('marcelstaal2002@gmail.com');
        $repository->save($company);

        $updatedCompany = $repository->findById(new SimpleUuidUsingRamsey('3d5a8e3b-bf2c-47e7-9f9f-84c6cddff1e4'));
        $this->assertTrue(Name::fromString('Marcels Symfony House')->equals($updatedCompany->name));
        $this->assertTrue(Email::fromString('marcelstaal2002@gmail.com')->equals($updatedCompany->email));
    }

    private function getTestCompany(string $id): Company
    {
        return new Company(
            new SimpleUuidUsingRamsey($id),
            Name::fromString('Marcels Laravel House'),
            OrganizationNumber::fromInt(22334455),
            Email::fromString('marcel2002@outlook.dk'),
            PhoneNumber::fromString('+4522365330'),
            Address::fromString('Damhusvej 97 2th'),
            City::fromString('Odense C'),
            PostalCode::fromInt(5000),
            new DateTimeImmutable('2025-05-02 20:40:00')
        );
    }
}
