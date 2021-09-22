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
        $validator = new Validator([]);
        $this->assertIsBool($validator->validate('foo'));
        $this->assertIsBool($validator->validate('bar'));
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
