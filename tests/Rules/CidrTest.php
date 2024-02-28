<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Cidr;
use PHPUnit\Framework\TestCase;

class CidrTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value)
    {
        $valid = (new Cidr())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '0.0.0.0/0'],
            [true, '10.0.0.0/8'],
            [true, '1.1.1.1/32'],
            [true, '192.168.1.0/24'],
            [true, '192.168.1.1/24'],
            [false, '192.168.1.1'],
            [false, '1.1.1.1/3.14'],
            [false, '1.1.1.1/33'],
            [false, '1.1.1.1/100'],
            [false, '1.1.1.1/-3'],
            [false, '1.1.1/3'],
        ];
    }
}
