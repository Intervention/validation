<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;

class Postalcode extends AbstractRule implements Rule, DataAwareRule
{
    /**
     * Field key for country to match postal code
     *
     * @var ?string
     */
    protected $locale;

    /**
     * Reference key to get locale from data
     *
     * @var ?string
     */
    protected $reference;

    /**
     * Data set used for validation
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new rule instance
     *
     * @param string $locale
     */
    public function __construct(?string $locale = null)
    {
        $this->locale = $locale;
    }

    /**
     * Set data
     *
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public static function reference(string $reference): self
    {
        $rule = new self();
        $rule->reference = $reference;

        return $rule;
    }

    public static function locale($locale): self
    {
        $locale = is_callable($locale) ? $locale() : $locale;

        return new self($locale);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($pattern = $this->getLocalePattern()) {
            return (bool) preg_match($pattern, $value);
        }

        return false;
    }

    protected function getLocale(): ?string
    {
        if (empty($this->locale)) {
            if (is_array($this->data) && array_key_exists($this->reference, $this->data)) {
                return $this->data[$this->reference];
            }
        }

        return $this->locale;
    }

    /**
     * Return regex pattern for postal code of current locale
     *
     * @return ?string
     */
    protected function getLocalePattern(): ?string
    {
        switch (strtolower($this->getLocale())) {
            case 'dz':
            case 'as':
            case 'ad':
            case 'de':
            case 'ba':
            case 'ic':
            case 'mp':
            case 'hr':
            case 'cu':
            case 'ee':
            case 'fi':
            case 'fr':
            case 'gf':
            case 'gp':
            case 'gu':
            case 'id':
            case 'it':
            case 'kr':
            case 'kv':
            case 'lt':
            case 'my':
            case 'mh':
            case 'mq':
            case 'yt':
            case 'fm':
            case 'mc':
            case 'me':
            case 'ma':
            case 'nc':
            case 'pk':
            case 'pw':
            case 'pr':
            case 're':
            case 'sm':
            case 'rs':
            case 'es':
            case 'xy':
            case 'th':
            case 'tr':
            case 'ua':
            case 'us':
            case 'vi':
                return "/^[0-9]{5}$/";

            case 'fo':
            case 'is':
            case 'mg':
            case 'pg':
                return "/^[0-9]{3}$/";

            case 'cz':
            case 'gr':
            case 'sk':
            case 'se':
                return "/^[0-9]{3} [0-9]{2}$/";

            case 'il':
                return "/^[0-9]{5}([0-9]{2})?$/";

            case 'br':
                return "/^[0-9]{5}(-?[0-9]{3})?$/";

            case 'gg':
            case 'je':
                return "/^[a-z]{2}[0-9][0-9]? [0-9][a-z]{2}$/i";

            case 'bn':
                return "/^[a-z]{2}[0-9]{4}$/i";

            case 'jp':
                return "/^[0-9]{3}-[0-9]{4}$/";

            case 'nl':
                return "/^[0-9]{4}( [a-z]{2})?$/i";

            case 'ar':
            case 'am':
            case 'au':
            case 'at':
            case 'bd':
            case 'be':
            case 'bg':
            case 'cy':
            case 'dk':
            case 'ge':
            case 'gl':
            case 'hu':
            case 'lv':
            case 'li':
            case 'lu':
            case 'mk':
            case 'md':
            case 'nz':
            case 'no':
            case 'ph':
            case 'si':
            case 'za':
            case 'ch':
            case 'tn':
                return "/^[0-9]{4}$/";

            case 'mv':
            case 'mx':
                return "/^[0-9]{4}[0-9]?$/";

            case 'mn':
                return "/^[0-9]{5}[0-9]?$/";

            case 'pl':
                return "/^[0-9]{2}-[0-9]{3}$/";

            case 'pt':
                return "/^[0-9]{4}(-[0-9]{3})?$/";

            case 'by':
            case 'cn':
            case 'ec':
            case 'in':
            case 'kz':
            case 'kg':
            case 'ro':
            case 'ru':
            case 'sg':
            case 'tj':
            case 'zu':
                return "/^[0-9]{6}$/";

            case 'ca':
                return "/^[a-z][0-9][a-z] [0-9][a-z]([0-9])?$/i";

            case 'az':
                return "/^[0-9]{4}([0-9]{2})?$/";

            case 'sz':
                return "/^[a-z]{1}[0-9]{3}$/i";

            case 'tw':
                return "/^[0-9]{3}([0-9]{2})?$/";

            case 'gb':
                return "/^(([a-z][0-9])|([a-z][0-9]{2})|([a-z][0-9][a-z])|([a-z]{2}[0-9])|([a-z]{2}[0-9]{2})|([a-z]{2}[0-9][a-z])) [0-9][a-z]{2}$/i";

            default:
                $pattern = null;
                break;
        }

        return $pattern;
    }
}
