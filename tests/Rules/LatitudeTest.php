<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Latitude;
use PHPUnit\Framework\TestCase;

final class LatitudeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Latitude())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, '-80'],
            [true, '0'],
            [true, '+50'],
            [true, '90'],
            [true, '-19.123'],
            [true, '0.11111'],
            [true, '+89.00000'],
            [true, '0.00000'],
            [true, '+89.00000'],
            [true, '89.99999'],
            [true, '90'],
            [true, '-90'],
            [false, '91'],
            [false, '-91'],
            [false, '90.000001'],
            [false, '-90.000001'],
        ];
    }
}
