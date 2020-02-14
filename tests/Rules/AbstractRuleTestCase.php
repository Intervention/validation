<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Bic;
use PHPUnit\Framework\TestCase;

abstract class AbstractRuleTestCase extends TestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [];

    /**
     * Classname of rule to test
     *
     * @var string
     */
    protected $classname;

    abstract public function getRuleClassname();

    /**
     * Setup test
     */
    protected function setUp(): void
    {
        $this->classname = $this->getRuleClassname();
    }

    public function testValid()
    {
        foreach ($this->getValidValues() as $value) {
            $this->assertTrue((new $this->classname($value))->isValid());
        }
    }

    public function testInvalid()
    {

        foreach ($this->getInvalidValues() as $value) {
            $this->assertFalse((new $this->classname($value))->isValid());
        }
    }

    protected function getValidValues()
    {
        return $this->valid;
    }

    protected function getInvalidValues()
    {
        return $this->invalid;
    }
}
