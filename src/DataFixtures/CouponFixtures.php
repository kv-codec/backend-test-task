<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Enum\CouponType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CouponFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $coupons = [
            new Coupon(
                code: 'percent10',
                type: CouponType::PERCENT,
                discount_size: 10,
            ),
            new Coupon(
                code: 'absolute5',
                type: CouponType::ABSOLUTE,
                discount_size: 5,
            ),
        ];
        array_walk($coupons, static fn($el) => $manager->persist($el));

        $manager->flush();
    }
}
