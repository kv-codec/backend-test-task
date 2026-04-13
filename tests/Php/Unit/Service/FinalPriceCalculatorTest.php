<?php

namespace App\Tests\Unit\Service;

use App\Dto\In\PriceCalculationDto;
use App\Dto\In\TaxNumberDto;
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
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

#[CoversClass(FinalPriceCalculator::class)]
final class FinalPriceCalculatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private FinalPriceCalculator $calculator;

    private readonly Uuid $productId;
    private readonly TaxNumberDto $taxNumber;
    private readonly PriceCalculationDto $percentDto;
    private readonly PriceCalculationDto $absoluteDto;

    private const PERCENT_COUPON_CODE  = 'percent10';
    private const ABSOLUTE_COUPON_CODE = 'absolute5';

    protected function setUp(): void
    {
        $this->productId   = Uuid::v7();
        $this->taxNumber   = new TaxNumberDto(GeoCode::Germany, '123456789');
        $this->percentDto  = new PriceCalculationDto($this->productId, $this->taxNumber, self::PERCENT_COUPON_CODE);
        $this->absoluteDto = new PriceCalculationDto($this->productId, $this->taxNumber, self::ABSOLUTE_COUPON_CODE);

        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('findOneByPublicId')
            ->with(Mockery::any())
            ->andReturn(new Product(
                name: 'Iphone',
                price: 100,
                id: $this->productId,
            ));

        $couponRepository = Mockery::mock(CouponRepository::class);
        $couponRepository->shouldReceive('findOneByCode')
            ->with(self::PERCENT_COUPON_CODE)
            ->andReturn(new Coupon(
                code: self::PERCENT_COUPON_CODE,
                type: CouponType::PERCENT,
                discount_size: 10,
            ));
        $couponRepository->shouldReceive('findOneByCode')
            ->with(self::ABSOLUTE_COUPON_CODE)
            ->andReturn(new Coupon(
                code: self::PERCENT_COUPON_CODE,
                type: CouponType::ABSOLUTE,
                discount_size: 5,
            ));

        $taxRepository = Mockery::mock(TaxRepository::class);
        $taxRepository->shouldReceive('findOneByGeoCode')
            ->with(Mockery::any())
            ->andReturn(new Tax(
                geoCode: GeoCode::Germany,
                rate: 19,
            ));

        $this->calculator = new FinalPriceCalculator($productRepository, $couponRepository, $taxRepository);
    }

    #[Test]
    public function returnsFloat(): void
    {
        self::assertIsFloat($this->calculator->calculate($this->percentDto));
    }

    #[Test]
    public function returnsCorrectFinalPriceForPercentCouponType(): void
    {
        // Coupon size: 10%, Germany tax rate: 19%
        self::assertSame(100 * (1 - 0.1) * (1 + 0.19), $this->calculator->calculate($this->percentDto));
    }

    #[Test]
    public function returnsCorrectFinalPriceForAbsoluteCouponType(): void
    {
        // Coupon size: 5, Germany tax rate: 19%
        self::assertSame((100 - 5) * (1 + 0.19), $this->calculator->calculate($this->absoluteDto));
    }
}
