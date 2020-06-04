<?php

namespace Intervention\Validation\Test\Rules;

class TitlecaseTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'Foo',
        'FooBar',
        'Foo Bar',
        'F Bar',
        '6 Bar',
        'FooBar Baz',
        'Foo Bar Baz',
        'Foo-Bar Baz',
        'Ba_r Baz',
        'F00 Bar Baz',
        'Ês Üm Ñõ',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'foo',
        'Foo ',
        ' Foo',
        'Foo bar',
        'foo bar',
        'Foo Bar baz',
        'Foo bar baz',
        '-fooBar',
        '-fooBar-',
        'The quick brown fox jumps over the lazy dog.',
    ];
}
