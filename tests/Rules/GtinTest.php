<?php

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Gtin;
use PHPUnit\Framework\TestCase;

class GtinTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Gtin())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderGtin8
    */
    public function testValidationGtin8($result, $value)
    {
        $valid = (new Gtin([8]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderGtin12
    */
    public function testValidationGtin12($result, $value)
    {
        $valid = (new Gtin([12]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderGtin13
    */
    public function testValidationGtin13($result, $value)
    {
        $valid = (new Gtin([13]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderGtin14
    */
    public function testValidationGtin14($result, $value)
    {
        $valid = (new Gtin([14]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '9789510475270'],
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
            [false, '1012345678905'],
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
            [true, '012345000058'],
            [false, 'foo'],
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
            [true, '000040123455'],
        ];
    }

    public function dataProviderGtin13()
    {
        return [
            [true, '9789510475270'],
            [true, '0012345000058'],
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
            [true, '0000040123455'],
            [true, '0012345000058'],
        ];
    }

    public function dataProviderGtin14()
    {
        return [
            [true, '00012345000058'],
            [false, 'w0012345000058'],
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
            [true, '00000040123455'],
            [true, '00012345000058'],
            [true, '05901234123457'],
        ];
    }
}
