<?php

namespace App\Validator;

use App\Dto\In\TaxNumberDto;
use App\Enum\GeoCode;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class TaxNumberValidator extends ConstraintValidator
{
    public const PATTERNS = [
        GeoCode::Germany->value => '/^\d{9}$/',
        GeoCode::France->value  => '/^[A-Z]{2}\d{9}$/',
        GeoCode::Italy->value   => '/^\d{11}$/',
        GeoCode::Greece->value  => '/^\d{9}$/',
    ];

    /**
     * @param TaxNumberDto $value
     * @param TaxNumber $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if ($value === null) {
            return; // NotBlank — отдельная ответственность
        }

        if (!$value) {
            throw new UnexpectedTypeException($value, TaxNumberDto::class);
        }

        if (!array_key_exists($value->geoCode->value, self::PATTERNS)) {
            $this->context
                ->buildViolation($constraint::UNKNOWN_COUNTRY_MESSAGE)
                ->setParameter('{{ value }}', $value->geoCode->value)
                ->addViolation();
            return;
        }

        if (!preg_match(self::PATTERNS[$value->geoCode->value], $value->number)) {
            $this->context
                ->buildViolation($constraint::INVALID_NUMBER_MESSAGE)
                ->setParameter('{{ value }}', $value->number)
                ->addViolation();
        }
    }
}
