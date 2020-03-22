<?php

namespace Intervention\Validation\Test\Rules;

class LowerCaseTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'a',
        'abc',
        'ß',
        'êçã',
        'valid',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'A',
        'ABC',
        'Ä',
        'ÄÖÜ',
        'VALID',
        'foo bar',
        'foo-bar',
        'ÇÃÊ',
        '!',
        '?',
        '9',
        '#',
    ];
}
