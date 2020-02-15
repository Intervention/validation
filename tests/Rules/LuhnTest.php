<?php

namespace Intervention\Validation\Test\Rules;

class LuhnTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '4444111122223333',
        '9501234400008',
        '446667651',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '9182819264532375',
        '12',
        '5555111122223333',
        'xxxxxxxxxxxxxxxx',
        '4444111I22223333',
    ];
}
