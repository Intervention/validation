<?php

namespace Intervention\Validation\Test\Rules;

class HexcolorTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'hexcolor';

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
        'x25s11', 'ffff', '#ffff', 'ff', '#', null, false, true
    ];
}
