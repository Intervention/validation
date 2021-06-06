<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use PHPUnit\Framework\TestCase;

class AbstractRuleTest extends TestCase
{
    public function testConstructor()
    {
        $value = 'foo';
        $attributes = ['bar', 'baz'];

        $rule = $this->getMockForAbstractClass(AbstractRule::class, [
            $value,
            $attributes,
        ]);
        $this->assertInstanceOf(AbstractRule::class, $rule);
        $this->assertEquals($value, $rule->getValue());
        $this->assertEquals($attributes, $rule->getAttributes());
    }

    public function testSetGetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $result = $rule->setValue('foo');
        $this->assertInstanceOf(AbstractRule::class, $result);
        $this->assertEquals('foo', $rule->getValue());
    }

    public function testSetGetAttributes()
    {
        $attributes = ['foo', 'bar'];
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $result = $rule->setAttributes($attributes);
        $this->assertInstanceOf(AbstractRule::class, $result);
        $this->assertEquals($attributes, $rule->getAttributes());
        $this->assertEquals('foo', $rule->getAttribute(0));
        $this->assertEquals('bar', $rule->getAttribute(1));
    }
}
