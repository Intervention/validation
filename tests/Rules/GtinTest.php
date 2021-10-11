<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Gtin;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class GtinTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Gtin()]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderGtin8
    */
    public function testValidationGtin8($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Gtin(8)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderGtin12
    */
    public function testValidationGtin12($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Gtin(12)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderGtin13
    */
    public function testValidationGtin13($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Gtin(13)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderGtin14
    */
    public function testValidationGtin14($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Gtin(14)]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '4012345678901'],
            [true, '0712345678911'],
            [true, '5901234123457'],
            [true, '40123455'],
            [true, '96385074'],
            [true, '65833254'],
            [true, '00123456000018'],
            [true, '012345678905'],
            [true, '012345000041'],
            [true, '012345000058'],
            [false, 'foo'],
            [false, '0000000000000'],
            [false, '0000000000001'],
            [false, 'FFFFFFFFFFFFF'],
            [false, 'FFFFFFFFFFFF0'],
            [false, '4012345678903'],
            [false, '1xxxxxxxxxxx0'],
            [false, '4012342678901'],
            [false, '07123456789110712345678911'],
            [false, '10123455'],
            [false, '40113455'],
            [false, '012341000058'],
        ];
    }

    public function dataProviderGtin8()
    {
        return [
            [false, '4012345678901'],
            [false, '0712345678911'],
            [false, '5901234123457'],
            [true, '40123455'],
            [true, '96385074'],
            [true, '65833254'],
            [false, '00123456000018'],
            [false, '012345678905'],
            [false, '012345000041'],
            [false, '012345000058'],
            [false, 'foo'],
            [false, '0000000000000'],
            [false, '0000000000001'],
            [false, 'FFFFFFFFFFFFF'],
            [false, 'FFFFFFFFFFFF0'],
            [false, '4012345678903'],
            [false, '1xxxxxxxxxxx0'],
            [false, '4012342678901'],
            [false, '07123456789110712345678911'],
            [false, '10123455'],
            [false, '40113455'],
            [false, '012341000058'],
        ];
    }

    public function dataProviderGtin12()
    {
        return [
            [false, '4012345678901'],
            [false, '0712345678911'],
            [false, '5901234123457'],
            [false, '40123455'],
            [false, '96385074'],
            [false, '65833254'],
            [false, '00123456000018'],
            [true, '012345678905'],
            [true, '012345000041'],
            [true, '012345000058'],
            [false, 'foo'],
            [false, '0000000000000'],
            [false, '0000000000001'],
            [false, 'FFFFFFFFFFFFF'],
            [false, 'FFFFFFFFFFFF0'],
            [false, '4012345678903'],
            [false, '1xxxxxxxxxxx0'],
            [false, '4012342678901'],
            [false, '07123456789110712345678911'],
            [false, '10123455'],
            [false, '40113455'],
            [false, '012341000058'],
        ];
    }

    public function dataProviderGtin13()
    {
        return [
            [true, '4012345678901'],
            [true, '0712345678911'],
            [true, '5901234123457'],
            [false, '40123455'],
            [false, '96385074'],
            [false, '65833254'],
            [false, '00123456000018'],
            [false, '012345678905'],
            [false, '012345000041'],
            [false, '012345000058'],
            [false, 'foo'],
            [false, '0000000000000'],
            [false, '0000000000001'],
            [false, 'FFFFFFFFFFFFF'],
            [false, 'FFFFFFFFFFFF0'],
            [false, '4012345678903'],
            [false, '1xxxxxxxxxxx0'],
            [false, '4012342678901'],
            [false, '07123456789110712345678911'],
            [false, '10123455'],
            [false, '40113455'],
            [false, '012341000058'],
        ];
    }

    public function dataProviderGtin14()
    {
        return [
            [false, '4012345678901'],
            [false, '0712345678911'],
            [false, '5901234123457'],
            [false, '40123455'],
            [false, '96385074'],
            [false, '65833254'],
            [true, '00123456000018'],
            [false, '012345678905'],
            [false, '012345000041'],
            [false, '012345000058'],
            [false, 'foo'],
            [false, '0000000000000'],
            [false, '0000000000001'],
            [false, 'FFFFFFFFFFFFF'],
            [false, 'FFFFFFFFFFFF0'],
            [false, '4012345678903'],
            [false, '1xxxxxxxxxxx0'],
            [false, '4012342678901'],
            [false, '07123456789110712345678911'],
            [false, '10123455'],
            [false, '40113455'],
            [false, '012341000058'],
        ];
    }
}
