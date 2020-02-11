<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use PHPUnit\Framework\TestCase;

class AbstractRuleTest extends TestCase
{
    public function testGetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $this->assertNull($rule->getValue());
    }

    public function testSetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $this->assertNull($rule->getValue());
        $result = $rule->setValue('foo');
        $this->assertEquals('foo', $rule->getValue());
        $this->assertInstanceOf(AbstractRule::class, $result);
    }
}
