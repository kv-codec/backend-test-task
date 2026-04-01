<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            new Product(name: 'Iphone', price: 100, id: '019d4cfa-bcfa-7cdf-bd0e-45755b6eccae'),
            new Product(name: 'Headphones', price: 20, id: '019d4cfa-bcfa-74fd-ad78-089908513a76'),
            new Product(name: 'Phoce case ', price: 10, id: '019d4cfa-bcfa-752c-bdb3-b6efcb682c4a'),
        ];
        array_map(static fn($el) => $manager->persist($el), $products);

        $manager->flush();
    }
}
