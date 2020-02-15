<?php

namespace Intervention\Validation\Test\Rules;

class IbanTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'DE12500105170648489890',
        'GB82 WEST 1234 5698 7654 32',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'DE21340155170648089890',
        'GR82 WEST 1234 5698 7654 32',
        '5070081',
    ];
}
