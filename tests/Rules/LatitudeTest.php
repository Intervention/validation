<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
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

    public static function dataProvider(): Generator
    {
        yield [true, '-80'];
        yield [true, '0'];
        yield [true, '+50'];
        yield [true, '90'];
        yield [true, '-19.123'];
        yield [true, '0.11111'];
        yield [true, '+89.00000'];
        yield [true, '0.00000'];
        yield [true, '+89.00000'];
        yield [true, '89.99999'];
        yield [true, '90'];
        yield [true, '-90'];
        yield [false, '91'];
        yield [false, '-91'];
        yield [false, '90.000001'];
        yield [false, '-90.000001'];
    }
}
