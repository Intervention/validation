<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class LatLng extends AbstractRegexRule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        $lat = substr((new Latitude())->pattern(), 2, -2);
        $lng = substr((new Longitude())->pattern(), 2, -2);

        return "/^" . $lat . ", ?" . $lng . "$/";
    }
}
