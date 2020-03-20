<?php

namespace Intervention\Validation;

abstract class AbstractStringRule extends AbstractRule
{
    /**
     * Return current value
     *
     * @return mixed
     */
    protected function getValue()
    {
        return @strval(parent::getValue());
    }
}
