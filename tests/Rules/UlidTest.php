<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Ulid;
use PHPUnit\Framework\TestCase;

final class UlidTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Ulid())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '01B8KYR6G8BC61CE8R6K2T16HY'];
        yield [true, '01b8kyr6g8bc61ce8r6k2t16hy'];
        yield [true, '01EBMHP6H7TT1Q4B7CA018K5MQ'];
        yield [true, '01AN4Z07BY79KA1307SR9X4MV3'];
        yield [true, '01BJ3J678K844ZTW53YPNB5K54'];
        yield [true, '7ZZZZZZZZZT103WW4FN24H45Y7'];
        yield [true, '7ZZZZZZZZZZZZZZZZZZZZZZZZZ'];
        yield [false, 'bar'];
        yield [false, 'bar'];
        yield [false, '01AN4Z07BY79KA1307SR9X4MV3F'];
        yield [false, '01AN4Z07BY79KA1307SR9X4MV'];
        yield [false, '01AN4ZÖ7BY79KA1307SR9X4MV3'];
        yield [false, '01AN4ZL7BY79KA1307SR9X4MV3'];
        yield [false, '01AN4Z_7BY79KA1307SR9X4MV3'];
        yield [false, '8ZZZZZZZZZZZZZZZZZZZZZZZZZ'];
    }
}
