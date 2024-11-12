<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Luhn;
use PHPUnit\Framework\TestCase;

final class LuhnTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Luhn())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '4444111122223333'];
        yield [true, '9501234400008'];
        yield [true, '446667651'];
        yield [true, 446667651];
        yield [false, '9182819264532375'];
        yield [false, '12'];
        yield [false, '5555111122223333'];
        yield [false, 'xxxxxxxxxxxxxxxx'];
        yield [false, '4444111I22223333'];
    }
}
