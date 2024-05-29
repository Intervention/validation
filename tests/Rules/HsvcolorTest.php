<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Hsvcolor;
use PHPUnit\Framework\TestCase;

final class HsvcolorTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Hsvcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, 'hsv(20, 100, 50)'],
            [true, 'hsv(20, 100%, 50%)'],
            [true, 'hsv(0, 100%, 50%)'],
            [true, 'hsv(0, 0%, 0%)'],
            [true, 'hsv(0,0%,0%)'],
            [true, 'hsv(0,0,0)'],
            [true, 'HSV(0,0,0)'],
            [true, 'hsv(360, 100%, 100%)'],
            [true, 'hsb(20, 100, 50)'],
            [true, 'hsb(20, 100%, 50%)'],
            [true, 'hsb(0, 100%, 50%)'],
            [true, 'hsb(0, 0%, 0%)'],
            [true, 'hsb(0,0%,0%)'],
            [true, 'hsb(0,0,0)'],
            [true, 'HSB(0,0,0)'],
            [true, 'hsb(360, 100%, 100%)'],
            [false, 'hsv(361, 101%, 101%)'],
            [false, 'hsv(-1, 0%, 0%)'],
            [false, 'hsb(361, 101%, 101%)'],
            [false, 'hsb(-1, 0%, 0%)'],
            [false, ''],
        ];
    }
}
