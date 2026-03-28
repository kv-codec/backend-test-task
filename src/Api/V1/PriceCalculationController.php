<?php

namespace App\Api\V1;

use App\Service\PriceCalculationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class PriceCalculationController
{
    public function __construct(
        private PriceCalculationService $priceCalculator,
    ) {}

    #[Route(
        path: '/calculate-price',
        methods: [Request::METHOD_POST],
        condition: 'request.headers.get("X-Accept-Version") === "v1"',
    )]
    public function calculatePrice(): Response
    {
        return new Response(status: Response::HTTP_OK);
    }
}
