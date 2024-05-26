<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

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

    public static function dataProvider(): array
    {
        return [
            [true, 'A12425GABC1234002M'],
            [true, 'a12425gabc1234002m'], // lowercase valid
            [true, 'GRid:A12425GABC1234002M'],
            [true, 'GRID:A12425GABC1234002M'],
            [true, 'A1-2425G-ABC1234002-M'],
            [true, 'A1-2425GABC1234002M'], // only one dash valid
            [true, 'GRid:A1-2425G-ABC1234002-M'],
            [true, 'GRID:A1-2425G-ABC1234002-M'],
            [true, 'A11244BC12345678DP'],
            [true, 'A1-1244B-C12345678D-P'],
            [true, 'GRid:A11244BC12345678DP'],
            [true, 'GRID:A11244BC12345678DP'],
            [true, 'GRid:A1-1244B-C12345678D-P'],
            [true, 'GRID:A1-1244B-C12345678D-P'],
            [false, 'FOO:A1-1244B-C12345678D-P'], // false prefix
            [false, 'B1-1244B-C12345678D-P'], // false Identifier Scheme element
            [false, 'A1-1244B-C12345678D-A'], // false Check Character
            [false, 'ZA9382189201'], // no grid
            [false, ''], // empty
        ];
    }
}
