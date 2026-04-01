<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
final class Product
{
    public function __construct(
        #[ORM\Column(length: 255)]
        public string $name {
            get => $this->name;
            set(string $value) => $this->name = $value;
        },
        #[ORM\Column(type: Types::BIGINT)] public int $price {
            get => $this->price;
            set(int $value) => $this->price = $value;
        },
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column] public ?Uuid $id = null {
            get => $this->id;
        },
    ) {}
}
