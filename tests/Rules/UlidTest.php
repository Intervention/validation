<?php

namespace Intervention\Validation\Test\Rules;

class UlidTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'ulid';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '01B8KYR6G8BC61CE8R6K2T16HY',
        '01b8kyr6g8bc61ce8r6k2t16hy',
        '01EBMHP6H7TT1Q4B7CA018K5MQ',
        '01AN4Z07BY79KA1307SR9X4MV3',
        '01BJ3J678K844ZTW53YPNB5K54',
        '7ZZZZZZZZZT103WW4FN24H45Y7',
        '7ZZZZZZZZZZZZZZZZZZZZZZZZZ',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        'bar',
        'bar',
        '01AN4Z07BY79KA1307SR9X4MV3F',
        '01AN4Z07BY79KA1307SR9X4MV',
        '01AN4ZÖ7BY79KA1307SR9X4MV3',
        '01AN4ZL7BY79KA1307SR9X4MV3',
        '01AN4Z_7BY79KA1307SR9X4MV3',
        '8ZZZZZZZZZZZZZZZZZZZZZZZZZ',
    ];
}
