<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\AustrianInsuranceNumber;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AustrianInsuranceNumberTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new AustrianInsuranceNumber())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '8757080475'];
        yield [true, '1230011471'];
        yield [false, '1234567890'];
        yield [false, '0123456789'];
        yield [false, '12345'];
        yield [false, '25bc78'];
        yield [false, '8753080475'];
        yield [false, 'foo'];
        yield [true, '1230 011471'];
        yield [false, '9999999999'];
        yield [false, '9999202501'];
        yield [false, '9999009901'];
        yield [true, '1680250250'];
    }
}
