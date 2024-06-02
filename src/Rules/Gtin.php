<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

class Gtin extends Ean
{
    /**
     * Create instance of gtin validation rule
     *
     * Value must be either GTIN-13 or GTIN-8, which is checked as EAN
     * by parent class. Or value must be GTIN-14 or GTIN-12 which will
     * be handled like this:
     *
     * - GTIN-14 will be checked as EAN-13 after cropping first char
     * - GTIN-12 will be checked as EAN-13 after adding leading zero
     *
     * @param array<int> $lengths
     * @return void
     */
    public function __construct(private array $lengths = [8, 12, 13, 14])
    {
        parent::__construct($this->lengths);
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        switch (strlen($value)) {
            case 8:
            case 13:
                return parent::isValid($value);

            case 14:
                return parent::checksumMatches(substr($value, 1));

            case 12:
                return parent::checksumMatches('0' . $value);
        }

        return false;
    }
}
