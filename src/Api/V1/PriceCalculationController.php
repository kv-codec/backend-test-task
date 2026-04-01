<?php

namespace App\Api\V1;

use App\Dto\In\PriceCalculationDto;
use App\Service\PriceCalculationService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

#[AsController]
final readonly class PriceCalculationController
{
    public function __construct(
        private LoggerInterface $logger,
        private PriceCalculationService $priceCalculator,
    ) {}

    #[Route(
        path: '/calculate-price',
        methods: [Request::METHOD_POST],
        condition: 'request.headers.get("X-Accept-Version") === "v1"',
        format: JsonEncoder::FORMAT,
    )]
    public function calculatePrice(#[MapRequestPayload] PriceCalculationDto $dto): Response
    {
        $this->logger->debug('Received: {dto}', ['dto' => $dto]);
        return new JsonResponse(status: Response::HTTP_OK);
    }
}
