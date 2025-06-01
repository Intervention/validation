<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Hslcolor;
use PHPUnit\Framework\TestCase;

final class HslcolorTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Hslcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'hsl(20, 100, 50)'];
        yield [true, 'hsl(20, 100%, 50%)'];
        yield [true, 'hsl(0, 100%, 50%)'];
        yield [true, 'hsl(0, 0%, 0%)'];
        yield [true, 'hsl(0,0%,0%)'];
        yield [true, 'hsl(0,0,0)'];
        yield [true, 'HSL(0,0,0)'];
        yield [true, 'hsl(360, 100%, 100%)'];
        yield [false, 'hsl(361, 101%, 101%)'];
        yield [false, 'hsl(-1, 0%, 0%)'];
        yield [false, ''];
    }
}
