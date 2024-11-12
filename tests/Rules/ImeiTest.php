<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Imei;
use PHPUnit\Framework\TestCase;

final class ImeiTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Imei())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '355689070069001'];
        yield [true, '861536030196001'];
        yield [true, '357631050052050'];
        yield [true, '357503040704274'];
        yield [false, '1'];
        yield [false, '123'];
        yield [false, '355689070069000'];
        yield [false, '011536020196001'];
        yield [false, '352192973771959'];
        yield [false, '111111111111111'];
        yield [false, 'ABCDEFGHIJKLMNO'];
        yield [false, '4444111122223333'];
    }
}
