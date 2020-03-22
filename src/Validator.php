<?php

namespace Intervention\Validation;

class Validator
{
    /**
     * Current rule
     *
     * @var AbstractRule
     */
    protected static $rule;

    /**
     * Create new instance
     *
     * @param AbstractRule $rule
     */
    public function __construct(AbstractRule $rule)
    {
        self::$rule = $rule;
    }

    /**
     * Overwrite current rule
     *
     * @param AbstractRule $rule
     */
    public function setRule(AbstractRule $rule): Validator
    {
        self::$rule = $rule;

        return $this;
    }

    /**
     * Return current rule
     *
     * @return AbstractRule
     */
    public function getRule(): AbstractRule
    {
        return self::$rule;
    }

    /**
     * Static constructor
     *
     * @param  AbstractRule $rule
     * @return self
     */
    public static function make(AbstractRule $rule): Validator
    {
        return new self($rule);
    }

    /**
     * Validate given value against current rule
     *
     * @param  mixed $value
     * @return boolean
     */
    public function validate($value): bool
    {
        return self::$rule->setValue($value)->isValid();
    }

    /**
     * Throw exception if value does not validate
     *
     * @param  mixed $value
     * @return void
     */
    public function assert($value): void
    {
        if (false === $this->validate($value)) {
            $this->throwInvalidException($value);
        }
    }

    /**
     * Magic method for static calls
     *
     * @param  string $name
     * @param  array  $arguments
     * @return boolean
     */
    public static function __callStatic(string $name, array $arguments): bool
    {
        $value = isset($arguments[0]) ? $arguments[0] : null;
        self::$rule = self::getRuleByCall($name)->setValue($value);

        return self::getReturnValueByCall($name);
    }

    /**
     * Return rule object by given static call name
     *
     * @param  string $call
     * @return AbstractRule
     */
    private static function getRuleByCall(string $call): AbstractRule
    {
        $class = sprintf('Intervention\Validation\Rules\%s', self::parseCall($call)['rule']);
        
        if (! class_exists($class)) {
            trigger_error(
                "Error: Call to undefined method ".$call,
                E_USER_ERROR
            );
        }
        
        return new $class;
    }

    /**
     * Get return value by static call name (is<RuleName> or assert<RuleName>)
     *
     * @param  string       $call
     * @return bool
     */
    private static function getReturnValueByCall(string $call): bool
    {
        $valid = self::$rule->isValid();

        if ($valid === false && self::parseCall($call)['type'] === 'assert') {
            self::throwInvalidException(self::$rule->getValue());
        }

        return $valid;
    }

    /**
     * Parse type (is|assert) and rule name out of given call name
     *
     * @param  string $call
     * @return array
     */
    private static function parseCall(string $call): array
    {
        $result = (bool) preg_match("/^(?P<type>is|assert)(?P<rule>.*)$/", $call, $matches);

        if ($result === false) {
            trigger_error(
                "Error: Call to undefined method ".$call,
                E_USER_ERROR
            );
        }

        return [
            'type' => $matches['type'],
            'rule' => $matches['rule'],
        ];
    }

    /**
     * Throw invalid validation exception
     *
     * @param  mixed $value
     * @return void
     */
    private static function throwInvalidException($value): void
    {
        $rulename = is_a(self::$rule, AbstractRule::class) ? get_class(self::$rule) : 'Unknown';

        throw new Exception\ValidationException(
            sprintf('Error validating value (%s) against rule "%s"', $value, $rulename)
        );
    }
}
