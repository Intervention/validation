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
        '85-359-0277-5',
        '048665088X',
        '9788371815102',
        '9971502100',
        '99921-58-10-7',
        '960 425 059 0',
        '9780306406157',
        '978-0-306-40615-7',
        '978 0 306 40615 7',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '123459181',
        '048665088A',
        '03064061521',
        '048662088X',
        '12',
        '123',
        'ABC',
        '978-0-306-40615-6',
        '99921-58-10-6',
    ];
}
