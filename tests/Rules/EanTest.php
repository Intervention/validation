<?php

namespace Intervention\Validation\Test\Rules;

class EanTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'ean';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '4012345678901',
        '0712345678911',
        '5901234123457',
        '40123455',
        '96385074',
        '65833254',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        'foo',
        '0000000000000',
        '0000000000001',
        'FFFFFFFFFFFFF',
        'FFFFFFFFFFFF0',
        '4012345678903',
        '1xxxxxxxxxxx0',
        '4012342678901',
        '07123456789110712345678911',
        '10123455',
        '40113455',
        '00123456000018', // GTIN-14
        '012345678905', // GTIN-12
    ];
}
