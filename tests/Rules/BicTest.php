<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Bic;

class BicTest extends AbstractRuleTestCase
{
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

    public function getRuleClassname()
    {
        return Bic::class;
    }
}
