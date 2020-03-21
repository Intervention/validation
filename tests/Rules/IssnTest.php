<?php

namespace Intervention\Validation\Test\Rules;

class IssnTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '2049-3630',
        // '2434-561X',
        // '1476-4687',
        // '0317-8471',
        // '1234-5679',
        // '1982-047x',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        '0317-8472',
        '1982047x',
        'DE0005810058',
        'ZA9382189201',
        '2434-561Y',
        '2434561X',
        'foo',
        '1234-1234',
    ];
}
