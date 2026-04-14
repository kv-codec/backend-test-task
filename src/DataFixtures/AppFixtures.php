<?php

namespace App\DataFixtures;

use App\Story\PriceCalculationStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Override;

class AppFixtures extends Fixture
{
    #[Override]
    public function load(ObjectManager $manager): void
    {
        PriceCalculationStory::load();
    }
}
