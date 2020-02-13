<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\Rules\HexColor;
use Intervention\Validation\Rules\Iban;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Error;

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
        $validator = Validator::make(new HexColor);
        $this->assertIsBool($validator->validate('#ccc'));
        $this->assertIsBool($validator->validate('xxx'));
    }

    public function testDynamicStaticCallValid()
    {
        $this->assertTrue(Validator::isHexColor('#cccccc'));
    }

    public function testDynamicStaticCallInvalid()
    {
        $this->expectException(Error::class);
        $this->assertTrue(Validator::isNonExisting('#cccccc'));
    }

    public function testSetGetRule()
    {
        $validator = new Validator(new HexColor);
        $this->assertInstanceOf(HexColor::class, $validator->getRule());

        $result = $validator->setRule(new Iban);
        $this->assertInstanceOf(Validator::class, $result);
        $this->assertInstanceOf(Iban::class, $validator->getRule());
    }
}
