<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Bic;
use PHPUnit\Framework\TestCase;

class BicTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value)
    {
        $valid = (new Bic())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider()
    {
        return [
            [true, 'PBNKDEFF'],
            [true, 'NOLADE21SHO'],
            [false, 'foobar'],
            [false, 'xxx'],
            [false, 'ABNFDBF'],
            [false, 'GR82WEST'],
            [false, '5070081'],
            [false, 'DEUTDBBER'],
        ];
    }
}
