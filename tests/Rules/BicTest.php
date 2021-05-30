<?php

namespace Intervention\Validation\Test\Rules;

class BicTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'bic';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'PBNKDEFF',
        'NOLADE21SHO',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'ABNFDBF',
        'GR82WEST',
        '5070081',
        'DEUTDBBER'
    ];
}
