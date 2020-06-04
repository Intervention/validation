<?php

namespace Intervention\Validation\Test\Rules;

class HtmlcleanTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        '123456',
        '1+2=3',
        'The quick brown fox jumps over the lazy dog.',
        '>>>test',
        '>test',
        'test>',
        'attr="test"',
        'one < two',
        'two>one',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'The quick brown fox jumps <strong>over</strong> the lazy dog.',
        '<html>',
        '<HTML>test</HTML>',
        '<html attr="test">',
        'Test</p>',
        'Test</>',
        'Test<>',
        '<0>',
        '<>',
        '><',
    ];
}
