<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

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
        if (! parent::isValid()) {
            return false;
        }

        $info = $this->dataUrlInfo();
        if ($info->isBase64Encoded()) {
            return (new Base64($info->data()))->isValid();
        }

        return true;
    }

    /**
     * Parse data url info from current value
     *
     * @return object
     */
    protected function dataUrlInfo(): object
    {
        preg_match($this->pattern, $this->getValue(), $matches);

        return new class ($matches)
        {
            private $matches;

            public function __construct($matches)
            {
                $this->matches = $matches;
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
