<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Bic;
use PHPUnit\Framework\TestCase;

final class BicTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Bic())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'PBNKDEFF'];
        yield [true, 'NOLADE21SHO'];
        yield [false, 'foobar'];
        yield [false, 'xxx'];
        yield [false, 'ABNFDBF'];
        yield [false, 'GR82WEST'];
        yield [false, '5070081'];
        yield [false, 'DEUTDBBER'];
    }
}
