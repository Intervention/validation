<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\AustrianInsuranceNumber;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AustrianInsuranceNumberTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new AustrianInsuranceNumber())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, '8757080475'],
            [true, '1230011471'],
            [false, '1234567890'],
            [false, '0123456789'],
            [false, '12345'],
            [false, '25bc78'],
            [false, '8753080475'],
            [false, 'foo'],
            [true, '1230 011471'],
            [false, '9999999999'],
            [false, '9999202501'],
            [false, '9999009901'],
            [true, '1680250250'],
        ];
    }
}
