<?php

namespace Intervention\Validation\Test\Rules;

class KebabCaseTest extends AbstractRuleTestCase
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
        'foo-bar-bâz',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'foo_bar',
        'foo-',
        '-foo',
        '-foo-',
        'fooBar',
        'Foo-bar',
        'foo-baR',
    ];
}
