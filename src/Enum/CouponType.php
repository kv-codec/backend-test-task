<?php

namespace App\Enum;

enum CouponType: string
{
    case PERCENT  = 'percent';
    case ABSOLUTE = 'absolute';
}
