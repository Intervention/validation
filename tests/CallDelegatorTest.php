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

    public function testGetRuleValue()
    {
        $delegator = new CallDelegator('foo', ['bar', 'baz', 'test']);
        $this->assertEquals('bar', $delegator->getRuleValue());
    }

    public function testGetRuleAttributes()
    {
        $delegator = new CallDelegator('isHexColor', ['bar', 'baz', 'test', 1, 2, 3]);
        $this->assertEquals(['baz', 'test', 1, 2, 3], $delegator->getRuleAttributes());
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

    public function testGetRuleReturnValueBoolean()
    {
        $delegator = new CallDelegator('isHexColor', ['ccc']);
        $this->assertTrue($delegator->getRuleReturnValue());
        $delegator = new CallDelegator('isHexColor', ['xxx']);
        $this->assertFalse($delegator->getRuleReturnValue());
    }

    public function testGetRuleReturnValueException()
    {
        $this->expectException(ValidationException::class);
        $delegator = new CallDelegator('assertHexColor', ['xxx']);
        $delegator->getRuleReturnValue();
    }
}
