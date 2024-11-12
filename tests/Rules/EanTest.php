<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Ean;
use PHPUnit\Framework\TestCase;

final class EanTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Ean())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderEan13')]
    public function testValidationEan13($result, $value): void
    {
        $valid = (new Ean([13]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderEan8')]
    public function testValidationEan8($result, $value): void
    {
        $valid = (new Ean([8]))->isValid($value);
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
        yield [false, '978-3499255496'];
        yield [false, '00123456000018']; // GTIN-1
        yield [false, '012345678905']; // GTIN-1
        yield [true, 5901234123457];
        yield [true, 40123455];
    }

    public static function dataProviderEan13(): Generator
    {
        yield [true, '9789510475270'];
        yield [true, '4012345678901'];
        yield [true, '0712345678911'];
        yield [true, '5901234123457'];
        yield [true, 5901234123457];
        yield [false, '40123455'];
        yield [false, '96385074'];
        yield [false, '65833254'];
    }

    public static function dataProviderEan8(): Generator
    {
        yield [false, '4012345678901'];
        yield [false, '0712345678911'];
        yield [false, '5901234123457'];
        yield [true, '40123455'];
        yield [true, '96385074'];
        yield [true, '65833254'];
        yield [true, 65833254];
    }
}
