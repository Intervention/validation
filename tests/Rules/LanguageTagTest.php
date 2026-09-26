<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\LanguageTag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class LanguageTagTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(
        bool $result,
        string $value,
        string $delimiter,
        bool $allowScript,
        bool $allowRegion,
        bool $allowVariants,
        bool $allowExtensions,
        bool $allowPrivateUse,
        bool $strict,
    ): void {
        $rule = new LanguageTag(
            $delimiter,
            $allowScript,
            $allowRegion,
            $allowVariants,
            $allowExtensions,
            $allowPrivateUse,
            $strict,
        );
        $this->assertEquals($rule->isValid($value), $result);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'de', '-', true, true, true, true, true, true];
        yield [true, 'de-DE', '-', true, true, true, true, true, true];
        yield [true, 'en-Latn-US', '-', true, true, true, true, true, true];
        yield [true, 'de-1996', '-', true, true, true, true, true, true];
        yield [true, 'sl-rozaj', '-', true, true, true, true, true, true];
        yield [true, 'sl-rozaj-biske', '-', true, true, true, true, true, true];
        yield [true, 'zh-Hans-CN', '-', true, true, true, true, true, true];
        yield [true, 'en-US-u-ca-gregory', '-', true, true, true, true, true, true];
        yield [true, 'fr-CA-x-company', '-', true, true, true, true, true, true];

        yield [true, 'de', '-', false, false, false, false, false, true]; // disallow all
        yield [false, 'de-', '-', false, false, false, false, false, true]; // disallow all
        yield [false, 'de-DE', '-', true, false, true, true, true, true]; // disallow region
        yield [false, 'en-Latn-US', '-', false, true, true, true, true, true]; // disallow script
        yield [false, 'fr-CA-x-company', '-', true, true, true, true, false, true]; // disallow privateuse

        yield [false, 'de-de', '-', false, true, false, false, false, true]; // lowercase language+region but strict
        yield [true, 'de-de', '-', false, true, false, false, false, false]; // lowercase language+region not strict
        yield [true, 'DE-DE', '-', false, true, false, false, false, false]; // uppercase language+region not strict

        yield [false, 'en-latn', '-', true, true, true, true, true, true]; // lowercase script but strict
        yield [true, 'en-latn', '-', true, true, true, true, true, false]; // lowercase script not strict

        yield [true, 'de_DE', '_', true, true, true, true, true, true]; // different delimiter

        yield [false, 'xxx', '_', true, true, true, true, true, true];
        yield [false, '___', '', true, true, true, true, true, true];
        yield [false, 'X-X', '', true, true, true, true, true, true];
        yield [false, 'x-x', '-', true, true, true, true, true, false];
    }
}
