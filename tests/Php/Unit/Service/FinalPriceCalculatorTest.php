<?php

namespace App\Tests\Unit\Service;

use App\Dto\In\PriceCalculationDto;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Enum\CouponType;
use App\Enum\GeoCode;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use App\Service\Impl\FinalPriceCalculator;
use Mockery;
use Symfony\Component\Uid\Uuid;

covers(FinalPriceCalculator::class);

describe('final price calculator', function (): void {
    /** @var FinalPriceCalculator $calculator */
    $calculator = null;
    $productId  = Uuid::v7();
    /** @var PriceCalculationDto $dto */
    $dto = new PriceCalculationDto($productId, 'DE0123456789', 'percent10');

    beforeEach(function () use (&$calculator, $productId): void {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('findOneByPublicId')
            ->with(Mockery::any())
            ->andReturn(new Product(
                name: 'Iphone',
                price: 100,
                id: $productId,
            ));
        $couponRepository = Mockery::mock(CouponRepository::class);
        $couponRepository->shouldReceive('findOneByCode')
            ->with(Mockery::any())
            ->andReturn(new Coupon(
                code: 'percent10',
                type: CouponType::PERCENT,
                discount_size: 10,
            ));
        $taxRepository = Mockery::mock(TaxRepository::class);
        $taxRepository->shouldReceive('findOneByGeoCode')
            ->with(Mockery::any())
            ->andReturn(new Tax(
                geoCode: GeoCode::Germany,
                rate: 19,
            ));
        $calculator = new FinalPriceCalculator($productRepository, $couponRepository, $taxRepository);
    });

    it(
        'returns float',
        function () use (&$calculator, $dto): void {
            expect($calculator->calculate($dto))->toBeFloat();
        },
    );

    it(
        'returns correct final price',
        function () use (&$calculator, $dto): void {
            /* Coupon size: 15%, France tax rate: 20% */
            expect($calculator->calculate($dto))->toBe(100 * (1 - 0.1) * (1 + 0.19));
        },
    );
});
