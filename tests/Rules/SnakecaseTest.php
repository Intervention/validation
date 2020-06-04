<?php

namespace Intervention\Validation\Test\Rules;

class SnakecaseTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'foo',
        'foo_bar',
        'foo_bar_baz',
        'foo_bar_bâz',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'foo-bar',
        'foo_',
        '_foo',
        '_foo-',
        'fooBar',
        'Foo_bar',
        'foo_baR',
    ];
}
