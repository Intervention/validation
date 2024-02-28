<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Creditcard;
use PHPUnit\Framework\TestCase;

class CreditcardTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value)
    {
        $valid = (new Creditcard())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '4444111122223333'],
            [false, '9182819264532375'],
            [false, '12'],
            [false, '5555111122223333'],
            [false, 'xxxxxxxxxxxxxxxx'],
            [false, '4444111I22223333'],
        ];
    }
}
