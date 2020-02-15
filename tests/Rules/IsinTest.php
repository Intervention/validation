<?php

namespace Intervention\Validation\Test\Rules;

class IsinTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'US0378331005',
        'DE0005810055'
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'DE0005810058',
        'ZA9382189201',
        'x',
        // ' ',
    ];
}
