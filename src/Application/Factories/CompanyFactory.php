<?php

namespace Application\Factories;

use Application\Commands\CreateCompanyCommand;
use DateTimeImmutable;
use Domain\Model\Company;
use Domain\Model\CompanyRepository;

readonly class CompanyFactory
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function createCompanyFrom(CreateCompanyCommand $command): Company
    {
        return new Company(
            $this->companyRepository->nextIdentity(),
            $command->name,
            $command->organizationNumber,
            $command->email,
            $command->phoneNumber,
            $command->address,
            $command->city,
            $command->postalCode,
            new DateTimeImmutable(),
        );
    }
}
