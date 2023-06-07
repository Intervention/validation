<?php

namespace Intervention\Validation\Traits;

trait HasCurrentLocale
{
    public static function getCurrentLocale(): string
    {
        $parts = explode('_', locale_get_default());
        if (is_array($parts) && array_key_exists(0, $parts)) {
            return $parts[0];
        }

        return 'en';
    }
}
