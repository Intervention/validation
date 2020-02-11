<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Iban;
use PHPUnit\Framework\TestCase;

class IbanTest extends TestCase
{
    public function testValid()
    {
        $values = ['DE12500105170648489890', 'GB82 WEST 1234 5698 7654 32'];
        foreach ($values as $value) {
            $this->assertTrue((new Iban($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = ['DE21340155170648089890', 'GR82 WEST 1234 5698 7654 32', '5070081'];
        foreach ($values as $value) {
            $this->assertFalse((new Iban($value))->isValid());
        }
    }
}
