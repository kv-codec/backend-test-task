<?php

namespace App\Dto\In;

use App\Enum\GeoCode;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class TaxNumberDto
{
    public function __construct(
        #[SerializedName('geoCode')]
        #[Assert\NotBlank]
        public GeoCode $geoCode,
        #[SerializedName('number')]
        #[Assert\NotBlank]
        public string $number,
    ) {}
}
