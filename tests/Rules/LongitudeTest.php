<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Longitude;
use PHPUnit\Framework\TestCase;

final class LongitudeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Longitude())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '0'];
        yield [true, '+90'];
        yield [true, '-90'];
        yield [true, '90'];
        yield [true, '+90.0000001'];
        yield [true, '-90.0000001'];
        yield [true, '90.00000001'];
        yield [true, '+180'];
        yield [true, '-180'];
        yield [true, '180'];
        yield [false, '180.0001'];
        yield [false, '-180.0001'];
    }
}
