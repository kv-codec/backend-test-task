<?php

namespace App\Service\Impl;

use App\Service\PurchaseService;
use Override;

final readonly class MockPaymentProcessor implements PurchaseService
{
    #[Override]
    public function process(): void {}
}
