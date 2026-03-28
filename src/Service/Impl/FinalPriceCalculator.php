<?php

namespace App\Service\Impl;

use App\Service\PriceCalculationService;
use Override;

final readonly class FinalPriceCalculator implements PriceCalculationService
{
    #[Override]
    public function calculate(): float
    {
        return 100.;
    }
}
