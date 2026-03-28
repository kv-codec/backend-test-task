<?php

namespace App\Tests\Unit\Service;

describe('sum', function (): void {
    it('1 + 1 == 2', function (): void {
        expect(1 + 1)->toBe(2);
    });

    it('2 + 2 == 4', function (): void {
        expect(2 + 2)->toBe(4);
    });
});
