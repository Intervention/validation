<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Base64 extends AbstractStringRule
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return base64_encode(base64_decode($this->getValue(), true)) === $this->getValue();
    }
    
    /**
     * Take into account base64 encoded image and return the current value
     *
     * @return mixed
     */
    public function getValue() {
        $value = parent::getValue();
        $pattern = "/^data:(?:image\/[a-zA-Z\-\.]+)(?:\+xml)?(?:charset=\".+\")?;base64,(?P<data>.+)$/";
        preg_match($pattern, $value, $matches);

        return isset($matches['data']) ? data_get($matches, 'data') : $value;
    }
}
