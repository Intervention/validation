<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Isbn;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class IsbnTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Isbn()]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderShort
    */
    public function testValidationShort($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Isbn(10)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderLong
    */
    public function testValidationLong($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Isbn(13)]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '3498016709'],
            [true, '978-3499255496'],
            [true, '85-359-0277-5'],
            [true, '048665088X'],
            [true, '9788371815102'],
            [true, '9971502100'],
            [true, '99921-58-10-7'],
            [true, '960 425 059 0'],
            [true, '9780306406157'],
            [true, '978-0-306-40615-7'],
            [true, '978 0 306 40615 7'],
            [false, '123459181'],
            [false, '048665088A'],
            [false, '03064061521'],
            [false, '048662088X'],
            [false, '12'],
            [false, '123'],
            [false, 'ABC'],
            [false, '978-0-306-40615-6'],
            [false, '99921-58-10-6'],
        ];
    }

    public function dataProviderShort()
    {
        return [
            [true, '3498016709'],
            [false, '978-3499255496'],
            [true, '85-359-0277-5'],
            [true, '048665088X'],
            [false, '9788371815102'],
            [true, '9971502100'],
            [true, '99921-58-10-7'],
            [true, '960 425 059 0'],
            [false, '9780306406157'],
            [false, '978-0-306-40615-7'],
            [false, '978 0 306 40615 7'],
            [false, '123459181'],
            [false, '048665088A'],
            [false, '03064061521'],
            [false, '048662088X'],
            [false, '12'],
            [false, '123'],
            [false, 'ABC'],
            [false, '978-0-306-40615-6'],
            [false, '99921-58-10-6'],
        ];
    }

    public function dataProviderLong()
    {
        return [
            [false, '3498016709'],
            [true, '978-3499255496'],
            [false, '85-359-0277-5'],
            [false, '048665088X'],
            [true, '9788371815102'],
            [false, '9971502100'],
            [false, '99921-58-10-7'],
            [false, '960 425 059 0'],
            [true, '9780306406157'],
            [true, '978-0-306-40615-7'],
            [true, '978 0 306 40615 7'],
            [false, '123459181'],
            [false, '048665088A'],
            [false, '03064061521'],
            [false, '048662088X'],
            [false, '12'],
            [false, '123'],
            [false, 'ABC'],
            [false, '978-0-306-40615-6'],
            [false, '99921-58-10-6'],
        ];
    }
}
