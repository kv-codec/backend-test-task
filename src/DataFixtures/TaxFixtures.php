<?php

namespace App\DataFixtures;

use App\Entity\Tax;
use App\Enum\GeoCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class TaxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $taxes = [
            new Tax(GeoCode::Germany, 19),
            new Tax(GeoCode::Italy, 22),
            new Tax(GeoCode::France, 20),
            new Tax(GeoCode::Greece, 24),
        ];
        array_walk($taxes, static fn($el) => $manager->persist($el));

        $manager->flush();
    }
}
