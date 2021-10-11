<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Iban;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class IbanTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Iban()]]);
        $this->assertEquals($result, $validator->passes());
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
