<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Gtin;
use PHPUnit\Framework\TestCase;

final class GtinTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Gtin())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderGtin8')]
    public function testValidationGtin8($result, $value): void
    {
        $valid = (new Gtin([8]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderGtin12')]
    public function testValidationGtin12($result, $value): void
    {
        $valid = (new Gtin([12]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderGtin13')]
    public function testValidationGtin13($result, $value): void
    {
        $valid = (new Gtin([13]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderGtin14')]
    public function testValidationGtin14($result, $value): void
    {
        $valid = (new Gtin([14]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '9789510475270'];
        yield [true, '4012345678901'];
        yield [true, '0712345678911'];
        yield [true, '5901234123457'];
        yield [true, '40123455'];
        yield [true, '96385074'];
        yield [true, '65833254'];
        yield [true, '00123456000018'];
        yield [true, '012345678905'];
        yield [true, '012345000041'];
        yield [true, '012345000058'];
        yield [false, 'foo'];
        yield [false, '0000000000001'];
        yield [false, 'FFFFFFFFFFFFF'];
        yield [false, 'FFFFFFFFFFFF0'];
        yield [false, '4012345678903'];
        yield [false, '1xxxxxxxxxxx0'];
        yield [false, '4012342678901'];
        yield [false, '07123456789110712345678911'];
        yield [false, '10123455'];
        yield [false, '40113455'];
        yield [false, '012341000058'];
        yield [false, '1012345678905'];
    }

    public static function dataProviderGtin8(): Generator
    {
        yield [false, '4012345678901'];
        yield [false, '0712345678911'];
        yield [false, '5901234123457'];
        yield [true, '40123455'];
        yield [true, '96385074'];
        yield [true, '65833254'];
        yield [false, '00123456000018'];
        yield [false, '012345678905'];
        yield [false, '012345000041'];
        yield [false, '012345000058'];
        yield [false, 'foo'];
        yield [false, '0000000000001'];
        yield [false, 'FFFFFFFFFFFFF'];
        yield [false, 'FFFFFFFFFFFF0'];
        yield [false, '4012345678903'];
        yield [false, '1xxxxxxxxxxx0'];
        yield [false, '4012342678901'];
        yield [false, '07123456789110712345678911'];
        yield [false, '10123455'];
        yield [false, '40113455'];
        yield [false, '012341000058'];
    }

    public static function dataProviderGtin12(): Generator
    {
        yield [false, '4012345678901'];
        yield [false, '0712345678911'];
        yield [false, '5901234123457'];
        yield [false, '40123455'];
        yield [false, '96385074'];
        yield [false, '65833254'];
        yield [false, '00123456000018'];
        yield [true, '012345678905'];
        yield [true, '012345000041'];
        yield [true, '012345000058'];
        yield [true, '012345000058'];
        yield [false, 'foo'];
        yield [false, '0000000000001'];
        yield [false, 'FFFFFFFFFFFFF'];
        yield [false, 'FFFFFFFFFFFF0'];
        yield [false, '4012345678903'];
        yield [false, '1xxxxxxxxxxx0'];
        yield [false, '4012342678901'];
        yield [false, '07123456789110712345678911'];
        yield [false, '10123455'];
        yield [false, '40113455'];
        yield [false, '012341000058'];
        yield [true, '000040123455'];
    }

    public static function dataProviderGtin13(): Generator
    {
        yield [true, '9789510475270'];
        yield [true, '0012345000058'];
        yield [true, '4012345678901'];
        yield [true, '0712345678911'];
        yield [true, '5901234123457'];
        yield [false, '40123455'];
        yield [false, '96385074'];
        yield [false, '65833254'];
        yield [false, '00123456000018'];
        yield [false, '012345678905'];
        yield [false, '012345000041'];
        yield [false, '012345000058'];
        yield [false, 'foo'];
        yield [false, '0000000000001'];
        yield [false, 'FFFFFFFFFFFFF'];
        yield [false, 'FFFFFFFFFFFF0'];
        yield [false, '4012345678903'];
        yield [false, '1xxxxxxxxxxx0'];
        yield [false, '4012342678901'];
        yield [false, '07123456789110712345678911'];
        yield [false, '10123455'];
        yield [false, '40113455'];
        yield [false, '012341000058'];
        yield [true, '0000040123455'];
        yield [true, '0012345000058'];
    }

    public static function dataProviderGtin14(): Generator
    {
        yield [true, '00012345000058'];
        yield [false, 'w0012345000058'];
        yield [false, '4012345678901'];
        yield [false, '0712345678911'];
        yield [false, '5901234123457'];
        yield [false, '40123455'];
        yield [false, '96385074'];
        yield [false, '65833254'];
        yield [true, '00123456000018'];
        yield [false, '012345678905'];
        yield [false, '012345000041'];
        yield [false, '012345000058'];
        yield [false, 'foo'];
        yield [false, '0000000000001'];
        yield [false, 'FFFFFFFFFFFFF'];
        yield [false, 'FFFFFFFFFFFF0'];
        yield [false, '4012345678903'];
        yield [false, '1xxxxxxxxxxx0'];
        yield [false, '4012342678901'];
        yield [false, '07123456789110712345678911'];
        yield [false, '10123455'];
        yield [false, '40113455'];
        yield [false, '012341000058'];
        yield [true, '00000040123455'];
        yield [true, '00012345000058'];
        yield [true, '05901234123457'];
    }
}
