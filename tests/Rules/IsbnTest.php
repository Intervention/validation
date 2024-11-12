<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Isbn;
use PHPUnit\Framework\TestCase;

final class IsbnTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Isbn())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderShort')]
    public function testValidationShort($result, $value): void
    {
        $valid = (new Isbn([10]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderLong')]
    public function testValidationLong($result, $value): void
    {
        $valid = (new Isbn([13]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, '3498016709'];
        yield [true, '3498016709'];
        yield [true, '978-3499255496'];
        yield [true, '85-359-0277-5'];
        yield [true, '048665088X'];
        yield [true, '9788371815102'];
        yield [true, '9971502100'];
        yield [true, '99921-58-10-7'];
        yield [true, '960 425 059 0'];
        yield [true, '9780306406157'];
        yield [true, '978-0-306-40615-7'];
        yield [true, '978 0 306 40615 7'];
        yield [false, '123459181'];
        yield [false, '048665088A'];
        yield [false, '03064061521'];
        yield [false, '048662088X'];
        yield [false, '12'];
        yield [false, '123'];
        yield [false, 'ABC'];
        yield [false, '978-0-306-40615-6'];
        yield [false, '99921-58-10-6'];
        yield [false, '0123456789012'];
    }

    public static function dataProviderShort(): Generator
    {
        yield [true, '3498016709'];
        yield [false, '978-3499255496'];
        yield [true, '85-359-0277-5'];
        yield [true, '048665088X'];
        yield [false, '9788371815102'];
        yield [true, '9971502100'];
        yield [true, '99921-58-10-7'];
        yield [true, '960 425 059 0'];
        yield [false, '9780306406157'];
        yield [false, '978-0-306-40615-7'];
        yield [false, '978 0 306 40615 7'];
        yield [false, '123459181'];
        yield [false, '048665088A'];
        yield [false, '03064061521'];
        yield [false, '048662088X'];
        yield [false, '12'];
        yield [false, '123'];
        yield [false, 'ABC'];
        yield [false, '978-0-306-40615-6'];
        yield [false, '99921-58-10-6'];
    }

    public static function dataProviderLong(): Generator
    {
        yield [false, '3498016709'];
        yield [true, '978-3499255496'];
        yield [false, '978-3495255496'];
        yield [false, '85-359-0277-5'];
        yield [false, '048665088X'];
        yield [true, '9788371815102'];
        yield [false, '9971502100'];
        yield [false, '99921-58-10-7'];
        yield [false, '960 425 059 0'];
        yield [true, '9780306406157'];
        yield [true, '978-0-306-40615-7'];
        yield [true, '978 0 306 40615 7'];
        yield [false, '123459181'];
        yield [false, '048665088A'];
        yield [false, '03064061521'];
        yield [false, '048662088X'];
        yield [false, '12'];
        yield [false, '123'];
        yield [false, 'ABC'];
        yield [false, '978-0-306-40615-6'];
        yield [false, '99921-58-10-6'];
        yield [false, '0123456789012'];
    }
}
