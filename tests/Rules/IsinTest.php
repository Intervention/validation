<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Isin;
use PHPUnit\Framework\TestCase;

final class IsinTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Isin())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'US0378331005'];
        yield [true, 'DE0005810055'];
        yield [false, 'DE0005810058'];
        yield [false, 'ZA9382189201'];
        yield [false, 'x'];
    }
}
