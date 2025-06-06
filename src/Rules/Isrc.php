<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Isrc extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^[A-Z]{2}[A-Z0-9]{3}\d{7}$/i";
    }

    public function isValid(mixed $value): bool
    {
        $normalized = $this->normalizeValue((string) $value);

        if ($normalized === null || $this->hasInvalidLength($normalized)) {
            return false;
        }

        return parent::isValid($normalized);
    }

    private function normalizeValue(string $value): ?string
    {
        $normalized = preg_replace('/[^A-Z0-9]/i', '', $value);

        return $normalized === null ? null : (string) $normalized;
    }

    private function hasInvalidLength(string $value): bool
    {
        return strlen($value) !== 12;
    }
}
