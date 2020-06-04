<?php

namespace Intervention\Validation\Test\Rules;

class LowercaseTest extends AbstractRuleTestCase
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
        'foo bar',
        'foo-bar',
        '!',
        '?',
        '9',
        '#',
        '',
        ' ',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'A',
        'ABC',
        'Ä',
        'ÄÖÜ',
        'VALID',
        'ÇÃÊ',
    ];
}
