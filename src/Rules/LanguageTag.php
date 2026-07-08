<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;
use Intervention\Validation\Traits\HasCountryCodeValues;
use Intervention\Validation\Traits\HasLanguageCodeValues;

class LanguageTag extends AbstractRule
{
    use HasLanguageCodeValues;
    use HasCountryCodeValues;

    public function __construct(
        protected string $delimiter = '-',
        protected bool $allowScript = false,
        protected bool $allowRegion = true,
        protected bool $allowVariants = false,
        protected bool $allowExtensions = false,
        protected bool $allowPrivateUse = false,
        protected bool $strict = true,
    ) {
        //
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $result = preg_match($this->pattern(), strval($value), $matches);

        if ($result !== 1) {
            return false;
        }

        $language = $matches['language'] ?? null;
        $region = $matches['region'] ?? null;

        $language = $language === '' ? null : $language;
        $region = $region === '' ? null : $region;

        if ($this->strict === false) {
            $language = $language === null ? $language : strtolower($language);
            $region = $region === null ? $region : strtoupper($region);
        }

        if (
            $this->allowRegion === true &&
            $region !== null &&
            !in_array($region, self::$countryCodeValues['alpha2'], strict: true)
        ) {
            return false;
        }

        return in_array($language, self::$languageCodeValues, strict: true);
    }

    /**
     * Build regex pattern according to parameters.
     */
    private function pattern(): string
    {
        $pattern = "/^";
        $pattern .= "(?P<language>[a-z]{2})";

        if ($this->allowScript === true) {
            $pattern .= "(?:" . $this->delimiter . "(?<script>[A-Z][a-z]{3}))?";
        }

        if ($this->allowRegion === true) {
            $pattern .= "(?:" . $this->delimiter . "(?<region>[A-Z]{2}))?";
        }

        if ($this->allowVariants === true) {
            $pattern .= "(?:" . $this->delimiter . "(?<variants>[A-Za-z0-9]{5,8}|\d[A-Za-z0-9]{3}))*";
        }

        if ($this->allowExtensions === true) {
            $pattern .= "(?:" . $this->delimiter . "(?<extensions>(?:[0-9A-WY-Za-wy-z])" .
                "(?:" . $this->delimiter . "[A-Za-z0-9]{2,8})+))?";
        }

        if ($this->allowPrivateUse === true) {
            $pattern .= "(?:" . $this->delimiter . "x(?<privateuse>(?:" . $this->delimiter . "[A-Za-z0-9]{1,8})+))?";
        }

        $pattern .= "$/";

        if ($this->strict === false) {
            $pattern .= "i";
        }

        return $pattern;
    }
}
