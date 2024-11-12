<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
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

    public static function dataProvider(): Generator
    {
        yield [true, '0, 0'];
        yield [true, '-80, 90'];
        yield [true, '0, +90'];
        yield [true, '+50, -180'];
        yield [true, '90, 180'];
        yield [true, '-19.123, +180'];
        yield [true, '0.11111, 12.123'];
        yield [true, '+89.00000, +12.123'];
        yield [true, '0.00000, -12.123'];
        yield [true, '+89.00000, -90'];
        yield [true, '89.99999, +90'];
        yield [true, '90, 150'];
        yield [true, '-90, 34.112311'];
        yield [true, '0,0'];
        yield [true, '-80,90'];
        yield [true, '0,+90'];
        yield [true, '+50,-180'];
        yield [true, '90,180'];
        yield [true, '-19.123,+180'];
        yield [true, '0.11111,12.123'];
        yield [true, '+89.00000,+12.123'];
        yield [true, '0.00000,-12.123'];
        yield [true, '+89.00000,-90'];
        yield [true, '89.99999,+90'];
        yield [true, '90,150'];
        yield [true, '-90,34.112311'];
        yield [false, '91, 0'];
        yield [false, '-91, 9'];
        yield [false, '90.000001, 0'];
        yield [false, '-90.000001, 0'];
        yield [false, '0, -200'];
        yield [false, '0, -180.12'];
        yield [false, '0, 180.12'];
        yield [false, '0, +180.12'];
    }
}
