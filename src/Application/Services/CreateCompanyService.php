<?php

declare(strict_types=1);

namespace Application\Services;

use Application\Commands\CreateCompanyCommand;
use Application\Factories\CompanyFactory;
use Domain\Model\CompanyRepository;
use Domain\SimpleUuidInterface;

final readonly class CreateCompanyService
{
    public function __construct(private CompanyRepository $companyRepository, private CompanyFactory $companyFactory)
    {
    }

    public function handle(CreateCompanyCommand $command): SimpleUuidInterface
    {
        return $this->companyRepository->save(
            $this->companyFactory->createCompanyFrom($command)
        );
    }
}
