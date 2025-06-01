<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Cidr;
use PHPUnit\Framework\TestCase;

final class CidrTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Cidr())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '0.0.0.0/0'];
        yield [true, '10.0.0.0/8'];
        yield [true, '1.1.1.1/32'];
        yield [true, '192.168.1.0/24'];
        yield [true, '192.168.1.1/24'];
        yield [false, '192.168.1.1'];
        yield [false, '1.1.1.1/3.14'];
        yield [false, '1.1.1.1/33'];
        yield [false, '1.1.1.1/100'];
        yield [false, '1.1.1.1/-3'];
        yield [false, '1.1.1/3'];
    }
}
