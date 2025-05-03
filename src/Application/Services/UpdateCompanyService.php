<?php

declare(strict_types=1);

namespace Application\Services;

use Application\Commands\UpdateCompanyCommand;
use Domain\Model\Company;
use Domain\Model\CompanyRepository;

final readonly class UpdateCompanyService
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(UpdateCompanyCommand $command): void
    {
        $this->companyRepository->save($this->fetchAndUpdateCompany($command));
    }

    private function fetchAndUpdateCompany(UpdateCompanyCommand $command): Company
    {
        $company = $this->companyRepository->findById($command->id);

        $company->name = $command->name;
        $company->organizationNumber = $command->organizationNumber;
        $company->email = $command->email;
        $company->phoneNumber = $command->phoneNumber;
        $company->address = $command->address;
        $company->city = $command->city;
        $company->postalCode = $command->postalCode;

        return $company;
    }
}
