<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;
use Intervention\Validation\Rules\Base64;

class DataUrl extends AbstractRegexRule
{
    /**
     * Data url pattern
     *
     * @var string
     */
    protected $pattern = "/^data:(?P<mediatype>\w+\/[-+.\w]+)?(?P<parameters>(;[-\w]+=[-\w]+)*)(?P<base64>;base64)?,(?P<data>.*)/";

    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        $info = $this->dataUrlInfo();
        if (! $info->isValid()) {
            return false;
        }

        if ($info->isBase64Encoded()) {
            return $this->base64DataValidator($info->data())->isValid();
        }

        return true;
    }

    /**
     * Validate base64 encoded data
     *
     * @param  mixed $input
     * @return Base64
     */
    protected function base64DataValidator($input): Base64
    {
        return new Base64($input);
    }

    /**
     * Parse data url info from current value
     *
     * @return object
     */
    protected function dataUrlInfo(): object
    {
        $result = preg_match($this->pattern, $this->getValue(), $matches);

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
