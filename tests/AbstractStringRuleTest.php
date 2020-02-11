<?php

namespace Intervention\Validation\Test;

use Intervention\Validation\AbstractStringRule;
use PHPUnit\Framework\TestCase;

class AbstractStringRuleTest extends TestCase
{
    public function testGetValue()
    {
        $rule = $this->getMockForAbstractClass(AbstractStringRule::class);
        $this->assertEquals('', $rule->getValue());
        $this->assertEquals('Array', $rule->setValue([])->getValue());
    }
}
