<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Htmlclean;
use PHPUnit\Framework\TestCase;

final class HtmlcleanTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Htmlclean())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '123456'];
        yield [true, '1+2=3'];
        yield [true, 'The quick brown fox jumps over the lazy dog.'];
        yield [true, '>>>test'];
        yield [true, '>test'];
        yield [true, 'test>'];
        yield [true, 'attr="test"'];
        yield [true, 'one < two'];
        yield [true, 'two>one'];
        yield [true, null];
        yield [false, 'The quick brown fox jumps <strong>over</strong> the lazy dog.'];
        yield [false, '<html>'];
        yield [false, '<HTML>test</HTML>'];
        yield [false, '<html attr="test">'];
        yield [false, 'Test</p>'];
        yield [false, 'Test</>'];
        yield [false, 'Test<>'];
        yield [false, '<0>'];
        yield [false, '<>'];
        yield [false, '><'];
    }
}
