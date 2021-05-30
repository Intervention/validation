<?php

namespace Intervention\Validation\Test\Rules;

class CamelcaseTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'camelcase';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'foo',
        'Foo',
        'fooBar',
        'fooBarBaz',
        'fooBarBâz',
        'fOo',
        'PostScript',
        'iPhone',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'foobaR',
        'FoobaR',
        'FOo',
        'FOO',
        'fo0bar',
        '-fooBar',
        '-fooBar-',
    ];
}
