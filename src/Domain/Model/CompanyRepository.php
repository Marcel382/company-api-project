<?php

declare(strict_types=1);

namespace Domain\Model;

use Domain\SimpleUuidInterface;


interface CompanyRepository
{
    public function save(Company $company): SimpleUuidInterface;

    public function nextIdentity(): SimpleUuidInterface;

    public function findById(SimpleUuidInterface $companyId): Company;

    /** @return list<Company> */
    public function findAll(): array;

    public function deleteCompanyWithId(SimpleUuidInterface $companyId): void;
}
