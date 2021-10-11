<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class MimeType extends AbstractRegexRule implements Rule
{
    protected function pattern(): string
    {
        return "/^(multipart|application|audio|image|message|multipart|text|video|font|example|model)\/([-+.\w]+)$/i";
    }
}
