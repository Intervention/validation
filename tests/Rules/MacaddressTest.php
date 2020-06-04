<?php

namespace Intervention\Validation\Test\Rules;

class MacaddressTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '00:80:41:ae:fd:7e',
        '12-34-56-78-9A-BC',
        '12-34-56-78-9a-bc',
        '008041aefd7e',
        '0080.41ae.fd7e',
        '008041-aefd7e',
        '00-80-41-ae-fd-7e',
        'A1:B2-C3:D4-E5:F6',
        '00-07-E9-cc-b2-dd',
        '00 07 E9 cc b2 dd',
        '000000000000',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'A1xB2xC3xD4xE5xFA',
        'A1:B2-C3:D4-E5:FX',
        '0000000000000',
        '123456',
        'XXX',
        'XXXXXXXXXXXX',
        '',
        false,
    ];
}
