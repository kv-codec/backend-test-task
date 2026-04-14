<?php

namespace App\Tests\Unit\Validator;

use App\Dto\In\TaxNumberDto;
use App\Enum\GeoCode;
use App\Validator\TaxNumber;
use App\Validator\TaxNumberValidator;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class TaxNumberValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): TaxNumberValidator
    {
        return new TaxNumberValidator();
    }

    #[Test]
    #[\PHPUnit\Framework\Attributes\DataProvider('validNumbersProvider')]
    public function validNumbers(TaxNumberDto $taxNumber): void
    {
        dump($taxNumber);
        $this->validator->validate($taxNumber, new TaxNumber());
        $this->assertNoViolation();
    }

    #[Test]
    #[\PHPUnit\Framework\Attributes\DataProvider('invalidNumbersProvider')]
    public function invalidNumbers(TaxNumberDto $taxNumber): void
    {
        $this->validator->validate($taxNumber, new TaxNumber());
        $this->buildViolation(TaxNumber::INVALID_NUMBER_MESSAGE)
            ->setParameter('{{ value }}', $taxNumber->number)
            ->assertRaised();
    }

    public static function validNumbersProvider(): array
    {
        return [
            [new TaxNumberDto(GeoCode::Germany, '123456789')],
            [new TaxNumberDto(GeoCode::Italy, '12345678901')],
            [new TaxNumberDto(GeoCode::Greece, '123456789')],
            [new TaxNumberDto(GeoCode::France, 'AB123456789')],
        ];
    }

    public static function invalidNumbersProvider(): array
    {
        return [
            [new TaxNumberDto(GeoCode::Germany, '12345678')], // 8 цифр вместо 9
            [new TaxNumberDto(GeoCode::Italy, '1234567890')], // 10 цифр вместо 11
            [new TaxNumberDto(GeoCode::Greece, '12345678')], // 8 цифр вместо 9
            [new TaxNumberDto(GeoCode::France, '00123456789')], // цифры вместо букв
        ];
    }
}
