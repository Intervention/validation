<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Intervention\Validation\AbstractRule;

class Postalcode extends AbstractRule implements DataAwareRule
{
    /**
     * Reference key to get locale from data
     */
    private ?string $reference = null;

    /**
     * Data set used for validation
     *
     * @var array<string>
     */
    private array $data = [];

    /**
     * Create a new rule instance with allowed countrycodes
     *
     * @param array<string> $countrycodes
     */
    public function __construct(protected array $countrycodes = [])
    {
        //
    }

    /**
     * Static constructor method to create data aware validation rule which
     * reads the allowed country code by reference.
     */
    public static function reference(string $reference): self
    {
        $rule = new self();
        $rule->reference = $reference;

        return $rule;
    }

    /**
     * Static constructor method
     *
     * @param array<string> $countrycodes
     */
    public static function countrycode(array $countrycodes): self
    {
        return new self($countrycodes);
    }

    /**
     * Set data
     *
     * @param array<mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        foreach ($this->patterns() as $pattern) {
            if (preg_match($pattern, (string) $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return regex patterns for allowed country codes
     *
     * @return array<string>
     */
    private function patterns(): array
    {
        $patterns = array_map(fn(string $countrycode): ?string => $this->pattern($countrycode), $this->countryCodes());

        return array_filter($patterns, fn(?string $pattern): bool => !is_null($pattern));
    }

    /**
     * Get array of allowed country codes
     *
     * @return array<string>
     */
    private function countryCodes(): array
    {
        if (count($this->countrycodes) != 0) {
            return $this->countrycodes;
        }

        // return country code by reference
        if (!is_null($this->reference) && array_key_exists($this->reference, $this->data)) {
            return [$this->data[$this->reference]];
        }

        return $this->countrycodes;
    }

    /**
     * Return regex pattern for postal code of current country code
     */
    private function pattern(string $countrycode): ?string
    {
        return match (strtolower($countrycode)) {
            'dz', 'as', 'ad', 'de', 'ba', 'ic', 'mp', 'hr', 'cu', 'ee', 'fi', 'fr', 'gf', 'gp', 'gu', 'id', 'it', 'kr',
            'kv', 'lt', 'my', 'mh', 'mq', 'yt', 'fm', 'mc', 'me', 'ma', 'nc', 'pk', 'pw', 'pr', 're', 'sm', 'rs',
            'es', 'xy', 'th', 'tr', 'ua', 'us', 'vi' => "/^[0-9]{5}$/",
            'fo', 'is', 'mg', 'pg' => "/^[0-9]{3}$/",
            'cz', 'gr', 'sk', 'se' => "/^[0-9]{3} [0-9]{2}$/",
            'il' => "/^[0-9]{5}([0-9]{2})?$/",
            'br' => "/^[0-9]{5}(-?[0-9]{3})?$/",
            'gg', 'je' => "/^[a-z]{2}[0-9][0-9]? [0-9][a-z]{2}$/i",
            'bn' => "/^[a-z]{2}[0-9]{4}$/i",
            'jp' => "/^[0-9]{3}-[0-9]{4}$/",
            'nl' => "/^[0-9]{4}\s?[a-z]{2}$/i",
            'ar', 'am', 'au', 'at', 'bd', 'be', 'bg', 'cy', 'dk', 'ge', 'gl', 'hu', 'lv', 'li', 'lu', 'mk', 'md', 'nz',
            'no', 'ph', 'si', 'za', 'ch', 'tn' => "/^[0-9]{4}$/",
            'mv', 'mx' => "/^[0-9]{4}[0-9]?$/",
            'mn' => "/^[0-9]{5}[0-9]?$/",
            'pl' => "/^[0-9]{2}-[0-9]{3}$/",
            'pt' => "/^[0-9]{4}(-[0-9]{3})?$/",
            'by', 'cn', 'ec', 'in', 'kz', 'kg', 'ro', 'ru', 'sg', 'tj', 'zu' => "/^[0-9]{6}$/",
            'ca' => "/^[a-z][0-9][a-z] [0-9][a-z]([0-9])?$/i",
            'az' => "/^[0-9]{4}([0-9]{2})?$/",
            'sz' => "/^[a-z]{1}[0-9]{3}$/i",
            'tw' => "/^[0-9]{3}([0-9]{2})?$/",
            'gb' => "/^(([a-z][0-9])|([a-z][0-9]{2})|([a-z][0-9][a-z])|([a-z]{2}[0-9])" .
                "|([a-z]{2}[0-9]{2})|([a-z]{2}[0-9][a-z])) [0-9][a-z]{2}$/i",
            'ie' => "/^[A-Za-z][A-Za-z0-9]{2} [A-Za-z0-9]{4}$/i",
            default => null,
        };
    }
}
