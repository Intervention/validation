<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Vin;
use PHPUnit\Framework\TestCase;

final class VinTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Vin())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderCheckDigit')]
    public function testValidationCheckDigit(bool $result, string $value): void
    {
        $valid = (new Vin(true))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'WP0ZZZ99ZTS392124'];
        yield [true, '5GZCZ43D13S812715'];
        yield [true, 'KLATF08Y1VB363636'];
        yield [true, 'SGZCZ43D13S812715'];
        yield [true, 'W0L000051T2123456'];
        yield [true, 'WDD1690071J236589'];
        yield [true, 'WVWZZZ1JZ3W386752'];
        yield [false, 'WVWZZZ1OZ3W386752'];
    }

    public static function dataProviderCheckDigit(): Generator
    {
        yield [true, '5GZCZ43D13S812715'];
        yield [false, 'WP0ZZZ99ZTS392124'];
        yield [false, 'KLATF08Y1VB363636'];
        yield [false, 'SGZCZ43D13S812715'];
        yield [false, 'W0L000051T2123456'];
        yield [false, 'WDD1690071J236589'];
        yield [false, 'WVWZZZ1JZ3W386752'];
        yield [false, 'WVWZZZ1OZ3W386752'];
    }
}
