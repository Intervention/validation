<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

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

    public static function dataProvider(): array
    {
        return [
            [true, '355689070069001'],
            [true, '861536030196001'],
            [true, '357631050052050'],
            [true, '357503040704274'],
            [false, '1'],
            [false, '123'],
            [false, '355689070069000'],
            [false, '011536020196001'],
            [false, '352192973771959'],
            [false, '111111111111111'],
            [false, 'ABCDEFGHIJKLMNO'],
            [false, '4444111122223333'],
        ];
    }
}
