<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Domainname extends AbstractStringRule
{
    /**
     * Determine if current input is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        $labels = $this->getLabels(); // get labels
        $tld = end($labels); // most right label is tld

        // min. 2 labels
        if (count($labels) <= 1) {
            return false;
        }

        // validate each label
        foreach ($labels as $label) {
            if (! $this->isValidLabel($label)) {
                return false;
            }
        }

        // validate tld
        if (! $this->isValidTld($tld)) {
            return false;
        }

        return true;
    }

    /**
     * Get all labels of domainname
     *
     * @return array
     */
    private function getLabels(): array
    {
        return explode('.', idn_to_ascii(parent::getValue()));
    }

    /**
     * Determine if given string is valid idn label
     *
     * @param  string  $value
     * @return boolean
     */
    private function isValidLabel(string $value): bool
    {
        return $this->isValidALabel($value) || $this->isValidNrLdhLabel($value);
    }

    /**
     * Determine if given value is valid A-Label
     *
     * Begins with "xn--" and is resolvable by PunyCode algorithm
     *
     * @param  string  $value
     * @return boolean
     */
    private function isValidALabel(string $value): bool
    {
        return substr($value, 0, 4) === 'xn--' && idn_to_utf8($value) !== false;
    }

    /**
     * Determine if given value is valud NR-LDH label
     *
     * @param  string  $string
     * @return boolean
     */
    private function isValidNrLdhLabel(string $value): bool
    {
        return (bool) preg_match("/^(?!\-)[a-z0-9\-]{1,63}(?<!\-)$/i", $value);
    }

    /**
     * Determine if given value is valid TLD
     *
     * @param  string  $value
     * @return boolean
     */
    private function isValidTld(string $value): bool
    {
        if ($this->isValidALabel($value)) {
            return true;
        }

        return (bool) preg_match("/^[a-z]{2,63}$/i", $value);
    }
}
