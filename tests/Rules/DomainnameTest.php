<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Domainname;
use PHPUnit\Framework\TestCase;

class DomainnameTest extends TestCase
{
    public function testValid()
    {
        $values = [
            'foo.com',
            'foo.bar',
            'foo.k12',
            'foo.photography',
            'foo.bar.baz',
            'foo-foo.foo-bar.baz',
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar',
            'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        ];

        foreach ($values as $value) {
            $this->assertTrue((new Domainname($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = [
            'foo',
            'foo..',
            'foo.bar-',
            '-foo.bar',
            'foo-.bar',
            'foo.-.bar',
            'foo.foo_bar.bar',
            'foo.123',
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar',
            'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx.xxxxxxxxxx',
        ];

        foreach ($values as $value) {
            $this->assertFalse((new Domainname($value))->isValid());
        }
    }
}
