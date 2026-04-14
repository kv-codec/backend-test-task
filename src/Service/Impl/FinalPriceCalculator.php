<?php

namespace App\Service\Impl;

use App\Dto\In\PriceCalculationDto;
use App\Enum\CouponType;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use App\Service\PriceCalculationService;
use Exception;
use Override;

final readonly class FinalPriceCalculator implements PriceCalculationService
{
    public function __construct(
        private ProductRepository $productRepository,
        private CouponRepository $couponRepository,
        private TaxRepository $taxRepository,
    ) {}

    #[Override]
    public function calculate(PriceCalculationDto $dto): float
    {
        $basePrice = $this->productRepository->findOneByPublicId($dto->productId)->price ?? throw new Exception(
            message: "Unable to find product with id({$dto->productId})",
        );
        $coupon    = $this->couponRepository->findOneByCode($dto->couponCode) ?? throw new Exception(
            message: "Unable to find coupon with code({$dto->couponCode})",
        );
        $taxRate   = $this->taxRepository->findOneByGeoCode($dto->taxNumber->geoCode) ?? throw new Exception(
            message: "Unable to find tax jurisdiction with geocode({$dto->taxNumber->geoCode})",
        );

        //INFO: $finalPrice = $basePrice * (1 - $couponSize) * (1 + $taxRate)
        //WARN: have to figure out applying order for absolute discount
        $finalPrice = match ($coupon->type) {
            CouponType::PERCENT => $basePrice * (1 - ($coupon->discount_size / 100)) * (1 + ($taxRate->rate / 100)),
            CouponType::ABSOLUTE => ($basePrice - $coupon->discount_size) * (1 + ($taxRate->rate / 100)),
        };
        return $finalPrice;
    }
}
