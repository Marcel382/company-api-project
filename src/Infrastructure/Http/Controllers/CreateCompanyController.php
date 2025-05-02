<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Application\Commands\CreateCompanyCommand;
use Application\Services\CreateCompanyService;
use Domain\Exceptions\CompanyCouldNotBeCreatedOrUpdated;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Infrastructure\Http\Requests\ManageCompanyRequest;
use RuntimeException;

final readonly class CreateCompanyController
{
    public function __construct(
        private CreateCompanyService $service,
        private ResponseFactory $responseFactory,
    ) {
    }

    public function __invoke(ManageCompanyRequest $request): JsonResponse
    {
        try {
            $companyId = $this->service->handle(new CreateCompanyCommand(
                $request->getName(),
                $request->getOrganizationNumber(),
                $request->getEmail(),
                $request->getPhoneNumber(),
                $request->getAddress(),
                $request->getCity(),
                $request->getPostalCode(),
            ));
        } catch (CompanyCouldNotBeCreatedOrUpdated $e) {
            return $this->responseFactory->json($e->getMessage(), 409);
        } catch (RuntimeException) {
            return $this->responseFactory->json('company could not be created. An unknown error occurred.', 500);
        }

        return $this->responseFactory->json(['id' => $companyId->toString()], 201);
    }
}
