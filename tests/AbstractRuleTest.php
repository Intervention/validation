<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractRule;
use PHPUnit\Framework\TestCase;

class AbstractRuleTest extends TestCase
{
    public function testSetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractRule::class);
        $result = $rule->setValue('foo');
        $this->assertInstanceOf(AbstractRule::class, $result);
    }
}
