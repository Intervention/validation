<?php

namespace Intervention\Validation\Test\Rules;

class UppercaseTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'uppercase';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'A',
        'ABC',
        'Ä',
        'ÄÖÜ',
        'VALID',
        'ÇÃÊ',
        '',
        ' ',
        '123',
        'A1',
        '_',
        '!',
        'A-B',
        'A B',
        '?',
        '#',
        'FOO BAR',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'a',
        'foo bar',
        'fooß',
        'abc',
        'äöü',
    ];
}
