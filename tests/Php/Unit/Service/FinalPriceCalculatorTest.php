<?php

namespace App\Tests\Unit\Service;

use App\Dto\In\PriceCalculationDto;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Impl\FinalPriceCalculator;
use Mockery;
use Symfony\Component\Uid\Uuid;

covers(FinalPriceCalculator::class);

describe('final price calculator', function (): void {
    /** @var FinalPriceCalculator $calculator */
    $calculator = null;
    $productId  = Uuid::v7();
    /** @var PriceCalculationDto $dto */
    $dto = new PriceCalculationDto($productId, 'FR0123456789', 'P15');

    beforeEach(function () use (&$calculator, $productId): void {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('findOneByPublicId')
            ->with(Mockery::any())
            ->andReturn(new Product(
                id: $productId,
                name: 'Iphone',
                price: 100,
            ));

        $calculator = new FinalPriceCalculator($productRepository);
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
            expect($calculator->calculate($dto))->toBe(100 * (1 - 0.15) * (1 + 0.2));
        },
    );
});
