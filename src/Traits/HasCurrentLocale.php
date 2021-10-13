<?php

namespace Intervention\Validation\Traits;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

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
