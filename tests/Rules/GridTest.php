<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Grid;
use PHPUnit\Framework\TestCase;

final class GridTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Grid())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'A12425GABC1234002M'];
        yield [true, 'a12425gabc1234002m']; // lowercase vali;
        yield [true, 'GRid:A12425GABC1234002M'];
        yield [true, 'GRID:A12425GABC1234002M'];
        yield [true, 'A1-2425G-ABC1234002-M'];
        yield [true, 'A1-2425GABC1234002M']; // only one dash vali;
        yield [true, 'GRid:A1-2425G-ABC1234002-M'];
        yield [true, 'GRID:A1-2425G-ABC1234002-M'];
        yield [true, 'A11244BC12345678DP'];
        yield [true, 'A1-1244B-C12345678D-P'];
        yield [true, 'GRid:A11244BC12345678DP'];
        yield [true, 'GRID:A11244BC12345678DP'];
        yield [true, 'GRid:A1-1244B-C12345678D-P'];
        yield [true, 'GRID:A1-1244B-C12345678D-P'];
        yield [false, 'FOO:A1-1244B-C12345678D-P']; // false prefi;
        yield [false, 'B1-1244B-C12345678D-P']; // false Identifier Scheme elemen;
        yield [false, 'A1-1244B-C12345678D-A']; // false Check Characte;
        yield [false, 'ZA9382189201']; // no gri;
        yield [false, '']; // empt;
    }
}
