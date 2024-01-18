<?php

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Iban;
use PHPUnit\Framework\TestCase;

class IbanTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Iban())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, 'DE12500105170648489890'],
            [true, 'GB82 WEST 1234 5698 7654 32'],
            [true, 'PK36SCBL0000001123456702'],
            [true, 'QA 54QNBA0000 00000000 693123456'],
            [true, 'CI93CI0080111301134291200589'],
            [true, 'NI92BAMC000000000000000003123123'],
            [false, 'DE21340155170648089890'],
            [false, 'GR82 WEST 1234 5698 7654 32'],
            [false, '5070081'],
            [false, 'KM4600005010010904400137'],
            [false, 'SA4420000001234567891231'],
        ];
    }
}
