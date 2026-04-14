<?php

namespace App\Dto\Out;

use Money\Money;
use Symfony\Component\Serializer\Attribute\SerializedName;

final readonly class PriceCalculationDto
{
    public function __construct(
        /* Returned value stores final price in smallest  */
        #[SerializedName('finalPrice')]
        public Money $finalPrice,
    ) {}
}
