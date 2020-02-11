<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Bic;
use PHPUnit\Framework\TestCase;

class BicTest extends TestCase
{
    public function testValid()
    {
        $values = ['PBNKDEFF', 'NOLADE21SHO'];
        foreach ($values as $value) {
            $this->assertTrue((new Bic($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = ['ABNFDBF', 'GR82WEST', '5070081'];
        foreach ($values as $value) {
            $this->assertFalse((new Bic($value))->isValid());
        }
    }
}
