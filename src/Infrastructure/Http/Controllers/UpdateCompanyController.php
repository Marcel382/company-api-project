<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Application\Commands\UpdateCompanyCommand;
use Application\Services\UpdateCompanyService;
use Domain\Exceptions\CompanyCouldNotBeCreatedOrUpdated;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Infrastructure\Http\Requests\ManageCompanyRequest;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use RuntimeException;

final readonly class UpdateCompanyController
{
    public function __construct(
        private UpdateCompanyService $service,
        private ResponseFactory $responseFactory,
    )
    {
    }

    public function __invoke(string $companyId, ManageCompanyRequest $request): JsonResponse
    {
        try {
            $this->service->handle(new UpdateCompanyCommand(
                New SimpleUuidUsingRamsey($companyId),
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
        } catch (RunTimeException) {
            return $this->responseFactory->json('Company could not be created. An unknown error occured.', 500);
        }

        return $this->responseFactory->json(['id' => $companyId]);
    }
}
