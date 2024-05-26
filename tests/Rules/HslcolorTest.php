<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Hslcolor;
use PHPUnit\Framework\TestCase;

final class HslcolorTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Hslcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, 'hsl(20, 100, 50)'],
            [true, 'hsl(20, 100%, 50%)'],
            [true, 'hsl(0, 100%, 50%)'],
            [true, 'hsl(0, 0%, 0%)'],
            [true, 'hsl(0,0%,0%)'],
            [true, 'hsl(0,0,0)'],
            [true, 'HSL(0,0,0)'],
            [true, 'hsl(360, 100%, 100%)'],
            [false, 'hsl(361, 101%, 101%)'],
            [false, 'hsl(-1, 0%, 0%)'],
            [false, ''],
        ];
    }
}
