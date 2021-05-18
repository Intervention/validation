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
        'PK36SCBL0000001123456702',
        'QA 54QNBA0000 00000000 693123456',
        'CI93CI0080111301134291200589',
        'NI92BAMC000000000000000003123123',
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
        'KM4600005010010904400137',
        'SA4420000001234567891231',
    ];
}
