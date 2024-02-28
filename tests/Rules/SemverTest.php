<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Semver;
use PHPUnit\Framework\TestCase;

class SemverTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Semver())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, '1.0.0'],
            [true, '0.0.0'],
            [true, '3.2.1'],
            [true, '1.0.0-alpha'],
            [true, '1.0.0-alpha.1'],
            [true, '1.0.0-alpha1'],
            [true, '1.0.0-1'],
            [true, '1.0.0-0.3.7'],
            [true, '1.0.0-x.7.z.92'],
            [true, '1.0.0+20130313144700'],
            [true, '1.0.0-beta+exp.sha.5114f85'],
            [true, '1000.1000.1000'],
            [false, '1'],
            [false, '1.0'],
            [false, 'v1.0.0'],
            [false, '1.0.0.0'],
            [false, 'x.x.x'],
            [false, '1.x.x'],
            [false, '10.0.0.beta'],
            [false, 'foo'],
        ];
    }
}
