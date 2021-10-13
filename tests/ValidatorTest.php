<?php

namespace Intervention\Validation\Test;

use Illuminate\Validation\Validator as IlluminateValidator;
use Intervention\Validation\Exceptions\ValidationException;
use Intervention\Validation\Rules\Hexcolor;
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
        $this->assertTrue(Validator::isHexcolor('ccc'));
        $this->assertFalse(Validator::isHexcolor('zzz'));
        $this->assertFalse(Validator::isHexcolor('ccc', 6));
        $this->assertTrue(Validator::isHexcolor('cccccc', 6));
    }

    public function testAssertFail()
    {
        $this->expectException(ValidationException::class);
        Validator::assertHexcolor('zzz');
    }

    public function testAssertSuccess()
    {
        $result = Validator::assertHexcolor('ccc');
        $this->assertTrue($result);
    }

    public function testErrorMessages()
    {
        locale_set_default('en');
        $validator = Validator::make(['value' => 'zzz'], ['value' => new Hexcolor()]);
        $message = 'The value must be a valid hexadecimal color code.';
        $this->assertEquals($message, $validator->errors()->first('value'));

        locale_set_default('de');
        $validator = Validator::make(['value' => 'zzz'], ['value' => new Hexcolor()]);
        $message = 'Der Wert value muss einen gültigen Hexadezimal Farbwert enthalten.';
        $this->assertEquals($message, $validator->errors()->first('value'));
    }
}
