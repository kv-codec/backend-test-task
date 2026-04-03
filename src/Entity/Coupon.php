<?php

namespace App\Entity;

use App\Enum\CouponType;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    public function __construct(
        #[ORM\Column(length: 255)]
        public string $code {
            get => $this->code;
            set => $this->code = $value;
        },

        #[ORM\Column(enumType: CouponType::class)]
        public CouponType $type {
            get => $this->type;
            set => $this->type = $value;
        },

        #[ORM\Column]
        public int $discount_size {
            get => $this->discount_size;
            set => $this->discount_size = $value;
        },
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        public ?int $id = null {
            get => $this->id;
        },
    ) {}
}
