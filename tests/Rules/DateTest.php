<?php

namespace Intervention\Validation\Test\Rules;

class DateTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '2013-12-01',
        '1970-12-8',
        '2012/02/29',
        '2002-11-13',
        '2002-12',
        '2002',
        '15.09.2002',
        '3/10/2002',
        '10/20',
        '20-10-20',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'name',
        '12345-',
        '_',
        '𝒕𝒆𝒔𝒕',
        '',
        'array()',
        'x',
        '$234_&',
        'ⓣⓔⓢⓣ',
        ',',
        '"',
        '\'',
        '2013-11-32',
        '20132-13-01',
        '2013-13-01',
        '1995/17/6',
        '20-17-20',
    ];
}
