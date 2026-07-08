<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\Traits\HasCountryCodeValues;
use InvalidArgumentException;

class CountryCode extends AbstractRule
{
    use HasCountryCodeValues;

    public const ALPHA2 = 'alpha2';
    public const ALPHA3 = 'alpha3';
    public const NUMERIC = 'numeric';

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(protected string $format = self::ALPHA2, protected bool $strict = true)
    {
        if (!in_array($this->format, [self::ALPHA2, self::ALPHA3, self::NUMERIC])) {
            throw new InvalidArgumentException('Invalid format.');
        }
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
            $value = strtoupper($value);
        }

        return in_array($value, self::$countryCodeValues[$this->format], strict: true);
    }
}
