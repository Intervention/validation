<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Isbn;
use PHPUnit\Framework\TestCase;

class IsbnTest extends TestCase
{
    public function testValid()
    {
        $values = ['3498016709', '978-3499255496', '85-359-0277-5'];
        foreach ($values as $value) {
            $this->assertTrue((new Isbn($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = ['123459181', '12', '123', 'ABC'];
        foreach ($values as $value) {
            $this->assertFalse((new Isbn($value))->isValid());
        }
    }
}
