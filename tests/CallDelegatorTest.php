<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\CallDelegator;
use Intervention\Validation\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class CallDelegatorTest extends TestCase
{
    public function testConstructor()
    {
        $delegator = new CallDelegator('foo', ['bar', 'baz', 'test']);
        $this->assertInstanceOf(CallDelegator::class, $delegator);
    }

    public function testGetValue()
    {
        $delegator = new CallDelegator('foo', ['bar', 'baz', 'test']);
        $this->assertEquals('bar', $delegator->getValue());
    }

    public function testGetRule()
    {
        $delegator = new CallDelegator('isHexColor', ['bar', 'baz', 'test']);
        $this->assertInstanceOf(AbstractRule::class, $delegator->getRule());
    }

    public function testGetRuleNonExisting()
    {
        $this->expectError();
        $delegator = new CallDelegator('foo', ['bar', 'baz', 'test']);
        $delegator->getRule();
    }

    public function testGetReturnValueBoolean()
    {
        $delegator = new CallDelegator('isHexColor', ['ccc']);
        $this->assertTrue($delegator->getReturnValue());
        $delegator = new CallDelegator('isHexColor', ['xxx']);
        $this->assertFalse($delegator->getReturnValue());
    }

    public function testGetReturnValueException()
    {
        $this->expectException(ValidationException::class);
        $delegator = new CallDelegator('assertHexColor', ['xxx']);
        $delegator->getReturnValue();
    }
}
