<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class MimeType extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^(multipart|application|audio|image|message|text|video|font|example|model)\/([-+.\w]+)$/i";
    }
}
