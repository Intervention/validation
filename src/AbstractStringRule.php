<?php

namespace Intervention\Validation;

abstract class AbstractStringRule extends AbstractRule
{
    /**
     * Return current value
     *
     * @return mixed
     */
    public function getValue()
    {
        return @strval(parent::getValue());
    }
}
