<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class MimeType extends AbstractRegexRule
{
    /**
     * Regular expression pattern for RGB hex color
     *
     * @var string
     */
    protected $pattern = "/^(multipart|application|audio|image|message|multipart|text|video|font|example|model)\/([-+.\w]+)$/i";
}
