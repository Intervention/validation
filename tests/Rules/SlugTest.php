<?php

namespace Intervention\Validation\Test\Rules;

class SlugTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'foo',
        'foo-bar',
        'foo-bar-baz',
        'Foo-Bar',
        'FOO-BAR',
        'FOO-123',
        '1-3',
        'f',
        'f-o-o',
        '0',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '-foo',
        'foo-',
        '-foo-bar-',
        'f--o',
        '-',
        ' ',
        'foo bar',
        'foo%20bar',
        'foo+bar',
        'foo_bar',
        'foo ',
        ' foo',
        '?',
        'föö',
    ];
}
