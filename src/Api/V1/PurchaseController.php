<?php

namespace App\Api\V1;

use App\Dto\In\PurchaseDto as InDto;
use App\Service\PurchaseService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

#[AsController]
final readonly class PurchaseController
{
    public function __construct(
        private PurchaseService $purchaseService,
    ) {}

    #[Route(
        path: '/calculate-price',
        methods: [Request::METHOD_POST],
        condition: 'request.headers.get("X-Accept-Version") === "v1"',
        format: JsonEncoder::FORMAT,
    )]
    public function purchase(#[MapRequestPayload] InDto $dto): JsonResponse
    {
        return new JsonResponse();
    }
}
