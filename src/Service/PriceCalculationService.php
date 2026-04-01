<?php

namespace App\Service;

use App\Dto\In\PriceCalculationDto;

interface PriceCalculationService
{
    public function calculate(PriceCalculationDto $dto): float;
}
