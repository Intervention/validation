<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class MimeType extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^(multipart|application|audio|image|message|text|video|font|example|model)\/([-+.\w]+)$/i";
    }
}
