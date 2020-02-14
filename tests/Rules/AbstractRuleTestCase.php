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

    /**
     * Return the classname of tested rule
     *
     * @return string
     */
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
        foreach ($this->valid as $value) {
            $this->assertTrue((new $this->classname($value))->isValid());
        }
    }

    public function testInvalid()
    {

        foreach ($this->invalid as $value) {
            $this->assertFalse((new $this->classname($value))->isValid());
        }
    }
}
