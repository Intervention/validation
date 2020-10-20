<?php

namespace Intervention\Validation\Test\Rules;

class CidrTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '0.0.0.0/0',
        '10.0.0.0/8',
        '1.1.1.1/32',
        '192.168.1.0/24',
        '192.168.1.1/24',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '192.168.1.1',
        '1.1.1.1/3.14',
        '1.1.1.1/33',
        '1.1.1.1/100',
        '1.1.1.1/-3',
        '1.1.1/3',
        '',
        false,
    ];
}
