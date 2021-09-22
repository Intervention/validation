<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\CallDelegator;
use Intervention\Validation\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Validation\Rule;

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
        $delegator = new CallDelegator('isHexcolor', ['foo', 3]);
        $this->assertInstanceOf(Rule::class, $delegator->getRule());
    }

    public function testGetAction()
    {
        $delegator = new CallDelegator('isHexColor', []);
        $this->assertEquals('validate', $delegator->getAction());

        $delegator = new CallDelegator('assertHexColor', []);
        $this->assertEquals('assert', $delegator->getAction());
    }

    public function testGetRuleNonExisting()
    {
        $this->expectError();
        $delegator = new CallDelegator('foo', ['bar', 'baz', 'test']);
        $delegator->getRule();
    }
}
