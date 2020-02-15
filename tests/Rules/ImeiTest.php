<?php

namespace Intervention\Validation\Test\Rules;

class ImeiTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '355689070069001',
        '861536030196001',
        '357631050052050',
        '357503040704274',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '1',
        '123',
        '355689070069000',
        '011536020196001',
        '352192973771959',
        '111111111111111',
        'ABCDEFGHIJKLMNO',
        '4444111122223333',
    ];
}
