<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\TcIdentification;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class TcIdentificationTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
     */
    public function testValidationConstructor($result, $tcIdentificationNumber, $fullName, $birthYear, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new TcIdentification($tcIdentificationNumber, $fullName, $birthYear)]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['tcidentification:' . $tcIdentificationNumber . ',' . $fullName . ',' . $birthYear]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidationStatic($result, $tcIdentificationNumber, $fullName, $birthYear, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [TcIdentification::verify($tcIdentificationNumber, $fullName, $birthYear)]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider(): array
    {
        return [
            [true, ***REMOVED***, 'Onur Kaçmaz', 1998],
            [false, ***REMOVED***, 'İsmail Kaçmaz', 1989],
        ];
    }
}
