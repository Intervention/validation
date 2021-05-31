<?php

namespace Intervention\Validation\Test\Rules;

class DataUrlTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'dataurl';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'data:,',
        'data:,foo',
        'data:;base64,Zm9v',
        'data:,foo%20bar',
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==',
        'data:text/vnd-example+xyz;foo=bar;base64,R0lGODdh',
        'data:text/vnd-example+xyz;foo=bar;bar-baz=false;base64,R0lGODdh',
        'data:text/plain;charset=UTF-8;page=21,the%20data:1234,5678',
        'data:text/plain;charset=US-ASCII,foobar',
        'data:text/plain,foobar',
        'data:,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy=',
        'data:,Hello%2C%20World%21',
        'data:text/plain;base64,SGVsbG8sIFdvcmxkIQ==',
        'data:text/html,<script>alert(\'hi\');</script>',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'foo',
        'bar',
        'data:',
        'data:;base64,foo',
        'data:;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy=',
        'data:image/jpeg;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy=',
        'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4=',
        'data:text;base64,SGVsbG8sIFdvcmxkIQ=='
    ];
}
