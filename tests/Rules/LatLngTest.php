<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\LatLng;
use PHPUnit\Framework\TestCase;

final class LatLngTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new LatLng())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, '0, 0'],
            [true, '-80, 90'],
            [true, '0, +90'],
            [true, '+50, -180'],
            [true, '90, 180'],
            [true, '-19.123, +180'],
            [true, '0.11111, 12.123'],
            [true, '+89.00000, +12.123'],
            [true, '0.00000, -12.123'],
            [true, '+89.00000, -90'],
            [true, '89.99999, +90'],
            [true, '90, 150'],
            [true, '-90, 34.112311'],
            [true, '0,0'],
            [true, '-80,90'],
            [true, '0,+90'],
            [true, '+50,-180'],
            [true, '90,180'],
            [true, '-19.123,+180'],
            [true, '0.11111,12.123'],
            [true, '+89.00000,+12.123'],
            [true, '0.00000,-12.123'],
            [true, '+89.00000,-90'],
            [true, '89.99999,+90'],
            [true, '90,150'],
            [true, '-90,34.112311'],
            [false, '91, 0'],
            [false, '-91, 9'],
            [false, '90.000001, 0'],
            [false, '-90.000001, 0'],
            [false, '0, -200'],
            [false, '0, -180.12'],
            [false, '0, 180.12'],
            [false, '0, +180.12'],
        ];
    }
}
