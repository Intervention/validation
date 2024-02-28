<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Kebabcase;
use PHPUnit\Framework\TestCase;

final class KebabcaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Kebabcase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
    {
        return [
            [true, 'foo'],
            [true, 'foo-bar'],
            [true, 'foo-bar-baz'],
            [true, 'foo-bar-bâz'],
            [false, 'foo_bar'],
            [false, 'foo-'],
            [false, '-foo'],
            [false, '-foo-'],
            [false, 'fooBar'],
            [false, 'Foo-bar'],
            [false, 'foo-baR'],
        ];
    }
}
