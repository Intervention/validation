<?php

namespace Intervention\Validation\Test\Rules;

class UppercaseTest extends AbstractRuleTestCase
{
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
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'a',
        'abc',
        '123',
        'A1',
        '_',
        '!',
        'A-B',
        'A B',
        '?',
        'äöü',
        '#',
        'ß',
    ];
}
