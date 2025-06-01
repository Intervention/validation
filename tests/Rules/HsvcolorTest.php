<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Hsvcolor;
use PHPUnit\Framework\TestCase;

final class HsvcolorTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Hsvcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'hsv(20, 100, 50)'];
        yield [true, 'hsv(20, 100%, 50%)'];
        yield [true, 'hsv(0, 100%, 50%)'];
        yield [true, 'hsv(0, 0%, 0%)'];
        yield [true, 'hsv(0,0%,0%)'];
        yield [true, 'hsv(0,0,0)'];
        yield [true, 'HSV(0,0,0)'];
        yield [true, 'hsv(360, 100%, 100%)'];
        yield [true, 'hsb(20, 100, 50)'];
        yield [true, 'hsb(20, 100%, 50%)'];
        yield [true, 'hsb(0, 100%, 50%)'];
        yield [true, 'hsb(0, 0%, 0%)'];
        yield [true, 'hsb(0,0%,0%)'];
        yield [true, 'hsb(0,0,0)'];
        yield [true, 'HSB(0,0,0)'];
        yield [true, 'hsb(360, 100%, 100%)'];
        yield [false, 'hsv(361, 101%, 101%)'];
        yield [false, 'hsv(-1, 0%, 0%)'];
        yield [false, 'hsb(361, 101%, 101%)'];
        yield [false, 'hsb(-1, 0%, 0%)'];
        yield [false, ''];
    }
}
