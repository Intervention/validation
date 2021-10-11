<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Semver;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class SemverTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Semver()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '1.0.0'],
            [true, '0.0.0'],
            [true, '3.2.1'],
            [true, '1.0.0-alpha'],
            [true, '1.0.0-alpha.1'],
            [true, '1.0.0-alpha1'],
            [true, '1.0.0-1'],
            [true, '1.0.0-0.3.7'],
            [true, '1.0.0-x.7.z.92'],
            [true, '1.0.0+20130313144700'],
            [true, '1.0.0-beta+exp.sha.5114f85'],
            [true, '1000.1000.1000'],
            [false, '1'],
            [false, '1.0'],
            [false, 'v1.0.0'],
            [false, '1.0.0.0'],
            [false, 'x.x.x'],
            [false, '1.x.x'],
            [false, '10.0.0.beta'],
            [false, 'foo'],
        ];
    }
}
