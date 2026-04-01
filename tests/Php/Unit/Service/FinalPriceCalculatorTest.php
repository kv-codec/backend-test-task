<?php

namespace App\Tests\Unit\Service;

use App\Service\Impl\FinalPriceCalculator;

covers(FinalPriceCalculator::class);

describe('final price calculator', function (): void {
    beforeEach(function (): void {
        /** @var FinalPriceCalculator $this */
        $this->calculator = new FinalPriceCalculator();
    });

    it('returns float', function (): void {
        /** @var FinalPriceCalculator $this */
        expect($this->calculator->calculate())->toBeFloat();
    });

    it('returns 100', function (): void {
        /** @var FinalPriceCalculator $this */
        expect($this->calculator->calculate())->toBe(100.0);
    });
});
