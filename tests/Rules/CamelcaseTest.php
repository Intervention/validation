<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Camelcase;
use PHPUnit\Framework\TestCase;

class CamelcaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value)
    {
        $valid = (new Camelcase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, 'foo'],
            [true, 'Foo'],
            [true, 'fooBar'],
            [true, 'fooBarBaz'],
            [true, 'fooBarBâz'],
            [true, 'fOo'],
            [true, 'PostScript'],
            [true, 'iPhone'],
            [false, 'foobaR'],
            [false, 'FoobaR'],
            [false, 'FOo'],
            [false, 'FOO'],
            [false, 'fo0bar'],
            [false, '-fooBar'],
            [false, '-fooBar-'],
        ];
    }
}
