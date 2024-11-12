<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Semver;
use PHPUnit\Framework\TestCase;

final class SemverTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Semver())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '1.0.0'];
        yield [true, '0.0.0'];
        yield [true, '3.2.1'];
        yield [true, '1.0.0-alpha'];
        yield [true, '1.0.0-alpha.1'];
        yield [true, '1.0.0-alpha1'];
        yield [true, '1.0.0-1'];
        yield [true, '1.0.0-0.3.7'];
        yield [true, '1.0.0-x.7.z.92'];
        yield [true, '1.0.0+20130313144700'];
        yield [true, '1.0.0-beta+exp.sha.5114f85'];
        yield [true, '1000.1000.1000'];
        yield [false, '1'];
        yield [false, '1.0'];
        yield [false, 'v1.0.0'];
        yield [false, '1.0.0.0'];
        yield [false, 'x.x.x'];
        yield [false, '1.x.x'];
        yield [false, '10.0.0.beta'];
        yield [false, 'foo'];
    }
}
