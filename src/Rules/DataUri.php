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
     *
     * @return bool
     */
    private function expectsMediaType(): bool
    {
        return is_array($this->media_types);
    }

    /**
     * Check for validity of given mime type
     *
     * @param mixed $value
     * @return bool
     */
    private function isValidMimeType(mixed $value): bool
    {
        return (new MimeType())->isValid($value);
    }

    /**
     * Check if give mime type is allowed
     *
     * @param mixed $type
     * @return bool
     */
    private function isAllowedMimeType(mixed $type): bool
    {
        if (is_null($this->media_types)) {
            return true;
        }

        if (count($this->media_types) === 0) {
            return false;
        }

        foreach ($this->media_types as $allowed) {
            if ($type === $allowed) {
                return true;
            }
        }

        return false;
    }

    private function isValidBase64EncodedValue(mixed $value): bool
    {
        return (new Base64())->isValid($value);
    }

    /**
     * Parse data url info from current value
     *
     * @param mixed $value
     * @return object
     */
    private function dataUriInfo(mixed $value): object
    {
        $pattern = "/^data:(?P<mediatype>\w+\/[-+.\w]+)?(?P<parameters>" .
            "(;[-\w]+=[-\w]+)*)(?P<base64>;base64)?,(?P<data>.*)/";
        $result = preg_match($pattern, strval($value), $matches);

        return new class ($matches, $result)
        {
            /**
             * Matches of regex operation
             *
             * @var array<mixed> $matches
             */
            private array $matches;

            /**
             * Result of regex operation
             *
             * @var int|false $result
             */
            private int|false $result;

            /**
             * @param array<mixed> $matches
             * @param int|false $result
             * @return void
             */
            public function __construct(array $matches, int|false $result)
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

            /** @return array<mixed> */
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
