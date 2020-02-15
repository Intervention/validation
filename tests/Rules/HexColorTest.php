<?php

namespace Intervention\Validation\Test\Rules;

class HexColorTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '#cccccc', 'b33517', '#ccc', 'ccc', 'abc'
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'x25s11', 'ffff', '#ffff', 'ff', '#', null, false, true, []
    ];
}
