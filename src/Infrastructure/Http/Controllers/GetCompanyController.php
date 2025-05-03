<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Domain\Exceptions\CompanyCouldNotBeFound;
use Domain\Model\CompanyRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Infrastructure\Support\SimpleUuidUsingRamsey;

final readonly class GetCompanyController
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private CompanyRepository $companyRepository,
    )
    {
    }

    public function __invoke(string $companyId): JsonResponse
    {
        try {
            $company = $this->companyRepository->findById(new SimpleUuidUsingRamsey($companyId));
        } catch (CompanyCouldNotBeFound $e) {
            return $this->responseFactory->json($e->getMessage(), 404);
        }

        return $this->responseFactory->json($company->toArray());
    }
}
