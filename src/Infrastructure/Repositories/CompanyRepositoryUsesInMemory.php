<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Exceptions\CompanyCouldNotBeCreatedOrUpdated;
use Domain\Exceptions\CompanyCouldNotBeFound;
use Domain\Model\Company;
use Domain\Model\CompanyRepository;
use Domain\SimpleUuidFactory;
use Domain\SimpleUuidInterface;
use RuntimeException;
use Throwable;

final class CompanyRepositoryUsesInMemory implements CompanyRepository
{
    /** @var array<string, Company> */
    private array $companies = [];

    public function __construct(private readonly SimpleUuidFactory $uuidFactory)
    {
    }

    public function save(Company $company): SimpleUuidInterface
    {
        $this->validateUniqueOrganizationNumber($company);

        try {
            $this->companies[$company->id->toString()] = $company;
        } catch (Throwable) {
            throw new RuntimeException();
        }

        return $company->id;
    }

    public function nextIdentity(): SimpleUuidInterface
    {
        return $this->uuidFactory->make();
    }

    public function findById(SimpleUuidInterface $companyId): Company
    {
        if (!array_key_exists($companyId->toString(), $this->companies)) {
            throw CompanyCouldNotBeFound::withId($companyId);
        }

        return $this->companies[$companyId->toString()];
    }

    public function findAll(): array
    {
        return array_values($this->companies);
    }

    public function deleteCompanyWithId(SimpleUuidInterface $companyId): void
    {
        if (!array_key_exists($companyId->toString(), $this->companies)) {
            throw CompanyCouldNotBeFound::withId($companyId);
        }

        unset($this->companies[$companyId->toString()]);
    }

    private function validateUniqueOrganizationNumber(Company $company): void
    {
        $duplicateOrganizationNumber = array_values(array_filter(
            $this->companies,
            static fn(Company $savedCompany) => $savedCompany->organizationNumber->equals($company->organizationNumber),
        ));

        if (count($duplicateOrganizationNumber) !== 0 && !$company->id->equals($duplicateOrganizationNumber[0]->id)) {
            throw CompanyCouldNotBeCreatedOrUpdated::forAlreadyExistingOrganizationNumber($company->organizationNumber);
        }
    }
}
