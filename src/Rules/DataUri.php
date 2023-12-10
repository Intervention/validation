<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class DataUri extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        $info = $this->dataUriInfo($value);
        if (! $info->isValid()) {
            return false;
        }

        if ($info->hasMediaType() && !$this->isValidMimeType($info->mediaType())) {
            return false;
        }

        if ($info->isBase64Encoded()) {
            return $this->isValidBase64EncodedValue($info->data());
        }

        return true;
    }

    protected function isValidMimeType(mixed $value): bool
    {
        return (new MimeType())->isValid($value);
    }

    protected function isValidBase64EncodedValue(mixed $value): bool
    {
        return (new Base64())->isValid($value);
    }

    /**
     * Parse data url info from current value
     *
     * @return object
     */
    protected function dataUriInfo($value): object
    {
        $pattern = "/^data:(?P<mediatype>\w+\/[-+.\w]+)?(?P<parameters>(;[-\w]+=[-\w]+)*)(?P<base64>;base64)?,(?P<data>.*)/";
        $result = preg_match($pattern, $value, $matches);

        return new class ($matches, $result)
        {
            private $matches;
            private $result;

            public function __construct($matches, $result)
            {
                $this->matches = $matches;
                $this->result = $result;
            }

            public function isValid(): bool
            {
                return (bool) $this->result;
            }

            public function mediaType(): ?string
            {
                if (isset($this->matches['mediatype']) && !empty($this->matches['mediatype'])) {
                    return $this->matches['mediatype'];
                }

                return null;
            }

            public function hasMediaType(): bool
            {
                return !empty($this->mediaType());
            }

            public function parameters(): array
            {
                if (isset($this->matches['parameters']) && !empty($this->matches['parameters'])) {
                    return explode(';', trim($this->matches['parameters'], ';'));
                }

                return [];
            }

            public function isBase64Encoded(): bool
            {
                if (isset($this->matches['base64']) && $this->matches['base64'] === ';base64') {
                    return true;
                }

                return false;
            }

            public function data(): ?string
            {
                if (isset($this->matches['data']) && !empty($this->matches['data'])) {
                    return $this->matches['data'];
                }

                return null;
            }
        };
    }
}
