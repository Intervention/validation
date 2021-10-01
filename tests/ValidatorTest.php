<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\Exception\ValidationException;
use Intervention\Validation\Rules\Hexcolor;
use Intervention\Validation\Rules\Iban;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testConstructor()
    {
        $validator = new Validator([]);
        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testMake()
    {
        $validator = Validator::make([]);
        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testSetRules()
    {
        $validator = new Validator([new Iban()]);
        $this->assertFalse($validator->validate('ccc'));
        $validator->setRules([new Hexcolor()]);
        $this->assertTrue($validator->validate('ccc'));
    }

    public function testValidate()
    {
        $validator = new Validator([new Hexcolor()]);
        $this->assertFalse($validator->validate('foo'));
        $this->assertTrue($validator->validate('ccc'));

        $validator = new Validator(['min:6', 'hexcolor']);
        $this->assertFalse($validator->validate('ccc'));
        $this->assertTrue($validator->validate('cccccc'));

        $validator = new Validator(['hexcolor']);
        $this->assertTrue($validator->validate('ccc'));
        $this->assertTrue($validator->validate('cccccc'));

        $validator = new Validator(['hexcolor:3']);
        $this->assertTrue($validator->validate('ccc'));
        $this->assertFalse($validator->validate('cccccc'));
    }

    public function testAssert()
    {
        $validator = new Validator([new Hexcolor()]);
        $this->expectException(ValidationException::class);
        $validator->assert('foo');
    }

    public function testDynamicStaticValidateValid()
    {
        $this->assertTrue(Validator::isHexColor('#cccccc'));
    }

    public function testDynamicStaticValidateInvalid()
    {
        $this->assertFalse(Validator::isHexColor('foo'));
    }

    public function testDynamicStaticAssert()
    {
        $this->expectException(ValidationException::class);
        Validator::assertHexColor('foo');
    }
}
