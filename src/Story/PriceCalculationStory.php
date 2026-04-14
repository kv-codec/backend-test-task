<?php

namespace App\Story;

use App\Enum\CouponType;
use App\Enum\GeoCode;
use App\Factory\CouponFactory;
use App\Factory\ProductFactory;
use App\Factory\TaxFactory;
use Symfony\Component\Uid\UuidV7;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'main')]
final class PriceCalculationStory extends Story
{
    public function build(): void
    {
        ProductFactory::createSequence([
            ['id' => new UuidV7('019d4dc6-6ee6-79c6-8cfa-e981c1ae2106'), 'name' => 'iphone', 'price' => 100],
            ['id' => new UuidV7('019d8668-b647-73a0-b7b2-3ebcb3d348a8'), 'name' => 'headphones', 'price' => 20],
            ['id' => new UuidV7('019d8668-b647-7a49-b23c-9a447fdab700'), 'name' => 'phone case', 'price' => 10],
        ]);

        CouponFactory::createSequence([
            ['code' => 'percent10', 'type' => CouponType::PERCENT, 'discount_size' => 10],
            ['code' => 'absolute5', 'type' => CouponType::ABSOLUTE, 'discount_size' => 5],
        ]);

        TaxFactory::createSequence([
            ['geoCode' => GeoCode::Germany, 'rate' => 19],
            ['geoCode' => GeoCode::Italy, 'rate' => 22],
            ['geoCode' => GeoCode::France, 'rate' => 20],
            ['geoCode' => GeoCode::Greece, 'rate' => 24],
        ]);
    }
}
