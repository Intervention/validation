<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\LanguageCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class LanguageCodeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidationAlpha2(bool $result, string $value, bool $strict): void
    {
        $valid = (new LanguageCode($strict))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'de', true];
        yield [true, 'en', true];
        yield [true, 'se', true];
        yield [true, 'cs', true];
        yield [true, 'EN', false];
        yield [false, 'cz', true];
        yield [false, 'us', true];
        yield [false, 'EN', true];
        yield [false, 'xx', true];
    }
}
