<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Isin;
use PHPUnit\Framework\TestCase;

final class IsinTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Isin())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, 'US0378331005'],
            [true, 'DE0005810055'],
            [false, 'DE0005810058'],
            [false, 'ZA9382189201'],
            [false, 'x'],
        ];
    }
}
