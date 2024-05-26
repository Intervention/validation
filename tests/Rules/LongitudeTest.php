<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Longitude;
use PHPUnit\Framework\TestCase;

final class LongitudeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Longitude())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, '0'],
            [true, '+90'],
            [true, '-90'],
            [true, '90'],
            [true, '+90.0000001'],
            [true, '-90.0000001'],
            [true, '90.00000001'],
            [true, '+180'],
            [true, '-180'],
            [true, '180'],
            [false, '180.0001'],
            [false, '-180.0001'],
        ];
    }
}
