<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Username;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    public function testValid()
    {
        $values = [
            'tom',
            'tester',
            'test',
            'test_',
            'mr_freeze',
            'mr-freeze',
            'r00t',
            'theQuickBrownFoxJump',
        ];

        foreach ($values as $value) {
            $this->assertTrue((new Username($value))->isValid());
        }
    }

    public function testInvalid()
    {
        $values = [
            'mr',
            'mr.freeze',
            'mr freeze',
            '-mr-freeze',
            '1337',
            '-91819',
            '&nbsp;',
            '<html></html>',
            '-_homer_-',
            '1mo',
            '_test_',
            '04420',
            '',
            ' ',
            'array()',
            'x',
            '$234_&',
            '?test=1',
            '€uro',
            'theQuickBrownFoxJumps',
            'SupersupersupersupersupersupersupersupersupersupersuperMan',
        ];

        foreach ($values as $value) {
            $this->assertFalse((new Username($value))->isValid());
        }
    }
}
