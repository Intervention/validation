<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class DataUri extends AbstractRule
{
    /**
     * Create new instance with allowed media types or null for all valid media types
     *
     * @param null|array<string> $media_types
     * @return void
     */
    public function __construct(private ?array $media_types = null)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $info = $this->dataUriInfo($value);

        if (!$info->isValid()) {
            return false;
        }

        if ($info->hasMediaType() && !$this->isValidMimeType($info->mediaType())) {
            return false;
        }

        if ($this->expectsMediaType() && !$info->hasMediaType()) {
            return false;
        }

        if ($this->expectsMediaType() && !$this->isAllowedMimeType($info->mediaType())) {
            return false;
        }

        if ($info->isBase64Encoded()) {
            return $this->isValidBase64EncodedValue($info->data());
        }

        return true;
    }

    /**
     * Determine if the rule expects a set mime type in the data url
     */
    private function expectsMediaType(): bool
    {
        return is_array($this->media_types);
    }

    /**
     * Check for validity of given mime type
     */
    private function isValidMimeType(mixed $value): bool
    {
        return (new MimeType())->isValid($value);
    }

    /**
     * Check if give mime type is allowed
     */
    private function isAllowedMimeType(mixed $type): bool
    {
        if (is_null($this->media_types)) {
            return true;
        }

        if ($this->media_types === []) {
            return false;
        }

        return in_array($type, $this->media_types, true);
    }

    private function isValidBase64EncodedValue(mixed $value): bool
    {
        return (new Base64())->isValid($value);
    }

    /**
     * Parse data url info from current value
     */
    private function dataUriInfo(mixed $value): object
    {
        $pattern = "/^data:(?P<mediatype>\w+\/[-+.\w]+)?(?P<parameters>" .
            "(;[-\w]+=[-\w]+)*)(?P<base64>;base64)?,(?P<data>.*)/";
        $result = preg_match($pattern, strval($value), $matches);

        return new class ($matches, $result)
        {
            /**
             * @param array<mixed> $matches
             * @return void
             */
            public function __construct(private array $matches, private int|false $result)
            {
                //
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

            /** @return array<mixed> */
            public function parameters(): array
            {
                if (isset($this->matches['parameters']) && !empty($this->matches['parameters'])) {
                    return explode(';', trim((string) $this->matches['parameters'], ';'));
                }

                return [];
            }

            public function isBase64Encoded(): bool
            {
                return isset($this->matches['base64']) && $this->matches['base64'] === ';base64';
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
