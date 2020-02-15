<?php

namespace Intervention\Validation\Test\Rules;

class UsernameTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'tom',
        'tester',
        'test',
        'test_',
        'mr_freeze',
        'mr-freeze',
        'r00t',
        'theQuickBrownFoxJump',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'mr',
        'mr.freeze',
        'mr freeze',
        '-mr-freeze',
        '1337',
        '-91819',
        '&nbsp;',
        '<html></html>',
        '-_homer_-',
        '1mo',
        '_test_',
        '04420',
        '',
        ' ',
        'array()',
        'x',
        '$234_&',
        '?test=1',
        '€uro',
        'theQuickBrownFoxJumps',
        'SupersupersupersupersupersupersupersupersupersupersuperMan',
    ];
}
