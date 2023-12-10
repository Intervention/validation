<?php

namespace Intervention\Validation\Test;

use Illuminate\Validation\Validator as IlluminateValidator;
use Intervention\Validation\Exceptions\ValidationException;
use Intervention\Validation\Rules\Hexadecimalcolor;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testMake()
    {
        $validator = Validator::make([], []);
        $this->assertInstanceOf(IlluminateValidator::class, $validator);
    }

    public function testIsRule()
    {
        $this->assertTrue(Validator::isHexadecimalcolor('ccc'));
        $this->assertFalse(Validator::isHexadecimalcolor('zzz'));
        $this->assertFalse(Validator::isHexadecimalcolor('ccc', 6));
        $this->assertTrue(Validator::isHexadecimalcolor('cccccc', 6));
    }

    public function testAssertFail()
    {
        $this->expectException(ValidationException::class);
        Validator::assertHexadecimalcolor('zzz');
    }

    public function testAssertSuccess()
    {
        $result = Validator::assertHexadecimalcolor('ccc');
        $this->assertTrue($result);
    }

    public function testErrorMessages()
    {
        locale_set_default('en');
        $validator = Validator::make(['value' => 'zzz'], ['value' => new Hexadecimalcolor()]);
        $message = 'The value must be a valid hexadecimal color code.';
        $this->assertEquals($message, $validator->errors()->first('value'));

        locale_set_default('de');
        $validator = Validator::make(['value' => 'zzz'], ['value' => new Hexadecimalcolor()]);
        $message = 'Der Wert value muss einen gültigen hexadezimalen Farbwert enthalten.';
        $this->assertEquals($message, $validator->errors()->first('value'));
    }
}
