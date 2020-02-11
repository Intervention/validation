<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Isin;
use PHPUnit\Framework\TestCase;

class IsinTest extends TestCase
{
    public function testValid()
    {
        $values = ['US0378331005', 'DE0005810055'];
        foreach ($values as $value) {
            $this->assertTrue((new Isin($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = ['DE0005810058', 'ZA9382189201'];
        foreach ($values as $value) {
            $this->assertFalse((new Isin($value))->isValid());
        }
    }
}
