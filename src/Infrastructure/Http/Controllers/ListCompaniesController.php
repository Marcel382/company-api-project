<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Domain\Model\Company;
use Domain\Model\CompanyRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final readonly class ListCompaniesController
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private CompanyRepository $companyRepository,
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $companies = $this->companyRepository->findAll();

        return $this->responseFactory->json(
            array_map(
                static fn (Company $company) => $company->toArray(),
                $companies,
            ),
        );
    }
}
