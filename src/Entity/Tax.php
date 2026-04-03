<?php

namespace App\Entity;

use App\Enum\GeoCode;
use App\Repository\TaxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxRepository::class)]
class Tax
{
    public function __construct(
        #[ORM\Column(enumType: GeoCode::class)]
        private(set) GeoCode $geoCode {
            get => $this->geoCode;
        },
        #[ORM\Column]
        public int $rate {
            get => $this->rate;
            set => $this->rate = $value;
        },
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private(set) ?int $id = null {
            get => $this->id;
        },
    ) {}
}
