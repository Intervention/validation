<?php

namespace Intervention\Validation;

class CallDelegator
{
    /**
     * Name of called method
     *
     * @var string
     */
    protected $name;

    /**
     * Arguments of called method
     *
     * @var array
     */
    protected $arguments;

    /**
     * Create new instance
     *
     * @param string $name
     * @param array  $arguments
     */
    public function __construct(string $name, array $arguments)
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * Get value to validate
     *
     * @return mixed
     */
    public function getValue()
    {
        return isset($this->arguments[0]) ? $this->arguments[0] : null;
    }

    /**
     * Get validation rule from current call
     *
     * @return AbstractRule
     */
    public function getRule(): AbstractRule
    {
        $classname = $this->getRuleClassname();
        
        return new $classname($this->getValue());
    }

    /**
     * Get return value of current validation rule
     *
     * @return bool
     */
    public function getReturnValue(): bool
    {
        $valid = $this->getRule()->isValid();

        if ($valid === false && self::parse('type') === 'assert') {
            throw new Exception\ValidationException(
                sprintf(
                    'Error validating value (%s) against rule "%s"',
                    $this->getValue(),
                    $this->getRuleClassname()
                )
            );
        }

        return $valid;
    }

    /**
     * Get classname according to current call
     *
     * @return string
     */
    private function getRuleClassname(): string
    {
        $classname = sprintf('Intervention\Validation\Rules\%s', $this->parse('rule'));
        
        if (! class_exists($classname)) {
            trigger_error(
                "Error: Unable to create not existing rule (" . $classname . ")",
                E_USER_ERROR
            );
        }

        return $classname;
    }

    /**
     * Parse information from current call
     *
     * @param  string $key
     * @return string
     */
    protected function parse(string $key): ?string
    {
        $pattern = "/^(?P<type>is|assert)(?P<rule>.*)$/";
        $result = (bool) preg_match($pattern, $this->name, $matches);

        if ($result === false) {
            trigger_error(
                "Error: Call to undefined method " . $this->name,
                E_USER_ERROR
            );
        }

        return array_key_exists($key, $matches) ? $matches[$key] : null;
    }
}
