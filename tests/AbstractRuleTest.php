<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use PHPUnit\Framework\TestCase;

class AbstractRuleTest extends TestCase
{
    public function testSetGetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $result = $rule->setValue('foo');
        $this->assertInstanceOf(AbstractRule::class, $result);
        $this->assertEquals('foo', $rule->getValue());
    }
}
