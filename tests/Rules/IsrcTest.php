<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Isrc;
use PHPUnit\Framework\TestCase;

final class IsrcTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Isrc())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'US-UAN-14-00011'];
        yield [true, 'USUAN1400011'];
        yield [true, 'GB-XXX-20-12345'];
        yield [true, 'GBXXX2012345'];
        yield [true, 'DE-A1B-99-00001'];
        yield [true, 'DEA1B9900001'];
        yield [true, 'QM-123-24-00001'];
        yield [true, 'QM1232400001'];
        yield [true, 'QZ-ABC-25-99999'];
        yield [true, 'QZABC2599999'];
        yield [true, 'QT-456-21-00123'];
        yield [true, 'QT4562100123'];
        yield [true, 'FR-789-00-00001'];
        yield [true, 'FR7890000001'];
        yield [true, 'US UAN 14 00011'];
        yield [true, 'us-uan-14-00011'];
        yield [true, 'US-uan-14-00011'];
        yield [true, 'gb-xxx-20-12345'];
        yield [true, 'de-a1b-99-00001'];
        yield [true, 'US/UAN/14/00011'];
        yield [true, 'US_UAN_14_00011'];
        yield [true, 'US.UAN.14.00011'];

        yield [false, 'US-UAN-14-0001'];
        yield [false, 'US-UAN-14-000111'];
        yield [false, 'USUAN140001'];
        yield [false, 'USUAN14000111'];
        yield [false, '1S-UAN-14-00011'];
        yield [false, 'U1-UAN-14-00011'];
        yield [false, 'U-UAN-14-00011'];
        yield [false, 'USA-UAN-14-00011'];
        yield [false, 'US--14-00011'];
        yield [false, 'US-UA-14-00011'];
        yield [false, 'US-UANN-14-00011'];
        yield [false, 'US-U@N-14-00011'];
        yield [false, 'US-UAN-1-00011'];
        yield [false, 'US-UAN-123-00011'];
        yield [false, 'US-UAN-AB-00011'];
        yield [false, 'US-UAN--00011'];
        yield [false, 'US-UAN-14-0001'];
        yield [false, 'US-UAN-14-000111'];
        yield [false, 'US-UAN-14-0001A'];
        yield [false, 'US-UAN-14-'];
        yield [false, ''];
        yield [false, 'foobar'];
        yield [false, '123456789012'];
        yield [false, 'ABCDEFGHIJKL'];

        yield [true, 'US-UAN-14-00011-'];
        yield [true, '-US-UAN-14-00011'];
        yield [true, 'US--UAN-14-00011'];
    }
}
