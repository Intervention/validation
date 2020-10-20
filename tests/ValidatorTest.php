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
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $validator = new Validator($rule);
        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testMake()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $validator = Validator::make($rule);
        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testValidate()
    {
        $validator = Validator::make(new Hexcolor());
        $this->assertIsBool($validator->validate('#ccc'));
        $this->assertIsBool($validator->validate('xxx'));
        $this->assertTrue($validator->validate('#ccc'));
        $this->assertFalse($validator->validate('xxx'));
    }

    public function testAssert()
    {
        $validator = Validator::make(new Hexcolor());
        $this->expectException(ValidationException::class);
        $validator->assert('foo');
    }

    public function testDynamicStaticIsValid()
    {
        $this->assertTrue(Validator::isHexColor('#cccccc'));
    }

    public function testDynamicStaticIsInvalid()
    {
        $this->assertFalse(Validator::isHexColor('foo'));
    }

    public function testDynamicStaticIsNonExisting()
    {
        $this->expectError();
        $this->assertTrue(Validator::isNonExisting('#cccccc'));
    }

    public function testDynamicStaticAssertValid()
    {
        $this->assertTrue(Validator::assertHexColor('#cccccc'));
    }

    public function testDynamicStaticAssertInvalid()
    {
        $this->expectException(ValidationException::class);
        $this->assertFalse(Validator::assertHexColor('foo'));
    }

    public function testDynamicStaticAssertNonExisting()
    {
        $this->expectError();
        $this->assertTrue(Validator::assertNonExisting('#cccccc'));
    }

    public function testNonExistingStaticCallType()
    {
        $this->expectError();
        $this->assertTrue(Validator::fooHexColor('#cccccc'));
    }

    public function testSetGetRule()
    {
        $validator = new Validator(new HexColor());
        $this->assertInstanceOf(HexColor::class, $validator->getRule());

        $result = $validator->setRule(new Iban());
        $this->assertInstanceOf(Validator::class, $result);
        $this->assertInstanceOf(Iban::class, $validator->getRule());
    }
}
