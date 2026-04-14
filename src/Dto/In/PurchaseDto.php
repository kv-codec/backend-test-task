<?php

namespace App\Dto\In;

use App\Validator\TaxNumber;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PurchaseDto
{
    public function __construct(
        #[Assert\Uuid(
            message: 'Not valid UUID::v7',
            versions: [Assert\Uuid::V7_MONOTONIC],
        )]
        #[SerializedName('product')]
        public Uuid $productId,
        //TODO: add validation for this 2 fields
        #[SerializedName('taxNumber')]
        #[TaxNumber]
        public TaxNumberDto $taxNumber,
        #[SerializedName('coupon')]
        public string $couponCode,
    ) {}
}
