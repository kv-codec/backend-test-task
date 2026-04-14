<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class TaxNumber extends Constraint
{
    public const string INVALID_NUMBER_MESSAGE = 'Invalid tax number format "{{ value }}".';

    public const string UNKNOWN_COUNTRY_MESSAGE = 'Unknown geocode in tax number "{{ value }}".';
}
