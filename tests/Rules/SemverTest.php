<?php

namespace Intervention\Validation\Test\Rules;

class SemverTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '1.0.0',
        '0.0.0',
        '3.2.1',
        '1.0.0-alpha',
        '1.0.0-alpha.1',
        '1.0.0-alpha1',
        '1.0.0-1',
        '1.0.0-0.3.7',
        '1.0.0-x.7.z.92',
        '1.0.0+20130313144700',
        '1.0.0-beta+exp.sha.5114f85',
        '1000.1000.1000',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '1',
        '1.0',
        'v1.0.0',
        '1.0.0.0',
        'x.x.x',
        '1.x.x',
        '10.0.0.beta',
        'foo',
    ];
}
