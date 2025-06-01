<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Creditcard;
use PHPUnit\Framework\TestCase;

final class CreditcardTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Creditcard())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '4444111122223333'];
        yield [false, '9182819264532375'];
        yield [false, '12'];
        yield [false, '5555111122223333'];
        yield [false, 'xxxxxxxxxxxxxxxx'];
        yield [false, '4444111I22223333'];
    }
}
