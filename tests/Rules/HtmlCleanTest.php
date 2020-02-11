<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\HtmlClean;
use PHPUnit\Framework\TestCase;

class HtmlCleanTest extends TestCase
{
    public function testValid()
    {
        $values = [
            '123456',
            '1+2=3',
            'The quick brown fox jumps over the lazy dog.',
            '>>>test',
            '>test',
            'test>',
            'attr="test"',
            'one < two',
            'two>one',
        ];

        foreach ($values as $value) {
            $this->assertTrue((new HtmlClean($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = [
            'The quick brown fox jumps <strong>over</strong> the lazy dog.',
            '<html>',
            '<HTML>test</HTML>',
            '<html attr="test">',
            'Test</p>',
            'Test</>',
            'Test<>',
            '<0>',
            '<>',
            '><',
        ];

        foreach ($values as $value) {
            $this->assertFalse((new HtmlClean($value))->isValid());
        }
    }
}
