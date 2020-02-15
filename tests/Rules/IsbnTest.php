<?php

namespace Intervention\Validation\Test\Rules;

class IsbnTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '3498016709',
        '978-3499255496',
        '85-359-0277-5'
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '123459181',
        '12',
        '123',
        'ABC'
    ];
}
