<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Creditcard;
use PHPUnit\Framework\TestCase;

class CreditcardTest extends TestCase
{
    public function testValid()
    {
        $values = ['4444111122223333'];
        foreach ($values as $value) {
            $this->assertTrue((new Creditcard($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = [
            '9182819264532375',
            '12',
            '5555111122223333',
            'xxxxxxxxxxxxxxxx',
            '4444111I22223333',
        ];
        foreach ($values as $value) {
            $this->assertFalse((new Creditcard($value))->isValid());
        }
    }
}
