<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Domainname extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $labels = $this->labels($value); // get labels of domainname
        $tld = end($labels); // most right label of domainname is tld

        // domain must have 2 labels minimum
        if (count($labels) <= 1) {
            return false;
        }

        // each label must be valid
        foreach ($labels as $label) {
            if (!$this->isValidLabel($label)) {
                return false;
            }
        }

        return $this->isValidTld($tld);
    }

    /**
     * Get all labels of domainname
     *
     * @return array<string>
     */
    private function labels(mixed $value): array
    {
        return explode('.', $this->idnToAscii($value));
    }

    /**
     * Determine if given string is valid idn label
     */
    private function isValidLabel(string $value): bool
    {
        return $this->isValidALabel($value) || $this->isValidNrLdhLabel($value);
    }

    /**
     * Determine if given value is valid A-Label
     *
     * Begins with "xn--" and is resolvable by PunyCode algorithm
     */
    private function isValidALabel(string $value): bool
    {
        return str_starts_with($value, 'xn--') && $this->idnToUtf8($value) != false;
    }

    /**
     * Determine if given value is valid NR-LDH label
     */
    private function isValidNrLdhLabel(string $value): bool
    {
        return (bool) preg_match("/^(?!\-)[a-z0-9\-]{1,63}(?<!\-)$/i", $value);
    }

    /**
     * Determine if given value is valid TLD
     */
    private function isValidTld(string $value): bool
    {
        if ($this->isValidALabel($value)) {
            return true;
        }

        return (bool) preg_match("/^[a-z]{2,63}$/i", $value);
    }

    /**
     * Wrapper method for idn_to_utf8 call
     */
    private function idnToUtf8(string $domain): string
    {
        return idn_to_utf8($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
    }

    /**
     * Wrapper method for idn_to_ascii call
     */
    private function idnToAscii(string $domain): string
    {
        $domain = idn_to_ascii($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);

        return $domain ?: '';
    }
}
