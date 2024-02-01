<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Luhn;
use PHPUnit\Framework\TestCase;

class LuhnTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Luhn())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '4444111122223333'],
            [true, '9501234400008'],
            [true, '446667651'],
            [true, 446667651],
            [false, '9182819264532375'],
            [false, '12'],
            [false, '5555111122223333'],
            [false, 'xxxxxxxxxxxxxxxx'],
            [false, '4444111I22223333'],
        ];
    }
}
