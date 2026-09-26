<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\Traits\HasLanguageCodeValues;

class LanguageCode extends AbstractRule
{
    use HasLanguageCodeValues;

    public function __construct(protected bool $strict = true)
    {
        //
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $value = strval($value);

        if ($this->strict === false) {
            $value = strtolower($value);
        }

        return in_array($value, self::$languageCodeValues, strict: true);
    }
}
