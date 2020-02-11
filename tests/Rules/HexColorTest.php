<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\HexColor;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class HexColorTest extends TestCase
{
    public function testValid()
    {
        $values = ['#cccccc', 'b33517', '#ccc', 'ccc', 'abc'];
        foreach ($values as $value) {
            $this->assertTrue((new HexColor($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = ['x25s11', 'ffff', '#ffff', 'ff', '#', null, false, true, []];
        foreach ($values as $value) {
            $this->assertFalse((new HexColor($value))->isValid());
        }
    }
}
