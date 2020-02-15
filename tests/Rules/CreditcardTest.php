<?php

namespace Intervention\Validation\Test\Rules;

class CreditcardTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '4444111122223333',
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
