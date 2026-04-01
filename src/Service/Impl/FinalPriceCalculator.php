<?php

namespace App\Service\Impl;

use App\Dto\In\PriceCalculationDto;
use App\Repository\ProductRepository;
use App\Service\PriceCalculationService;
use Exception;
use Override;

final readonly class FinalPriceCalculator implements PriceCalculationService
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {}

    #[Override]
    public function calculate(PriceCalculationDto $dto): float
    {
        $basePrice          = $this->productRepository->findOneByPublicId($dto->productId)->price ?? throw new Exception(
            message: "Unable to find product with id({$dto->productId})",
        );
        $couponDiscountSize = 0;
        $taxRate            = 0;

        //INFO: $finalPrice = $basePrice * (1 - $couponSize) * (1 + $taxRate)
        $finalPrice = $basePrice * (1 - $couponDiscountSize) * (1 + $taxRate);
        return $finalPrice; //TODO(kv-codec): return ACTUAL value
    }
}
