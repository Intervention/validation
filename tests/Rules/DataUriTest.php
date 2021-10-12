<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\DataUri;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class DataUriTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new DataUri()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, 'data:,'],
            [true, 'data:,foo'],
            [true, 'data:;base64,Zm9v'],
            [true, 'data:,foo%20bar'],
            [true, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg=='],
            [true, 'data:text/vnd-example+xyz;foo=bar;base64,R0lGODdh'],
            [true, 'data:text/vnd-example+xyz;foo=bar;bar-baz=false;base64,R0lGODdh'],
            [true, 'data:text/plain;charset=UTF-8;page=21,the%20data:1234,5678'],
            [true, 'data:text/plain;charset=US-ASCII,foobar'],
            [true, 'data:text/plain,foobar'],
            [true, 'data:,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='],
            [true, 'data:,Hello%2C%20World%21'],
            [true, 'data:text/plain;base64,SGVsbG8sIFdvcmxkIQ=='],
            [true, 'data:text/html,<script>alert(\'hi\');</script>'],
            [false, 'foo'],
            [false, 'bar'],
            [false, 'data:'],
            [false, 'data:;base64,foo'],
            [false, 'data:foo/plain,foobar'],
            [false, 'data:;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='],
            [false, 'data:image/jpeg;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='],
            [false, 'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4='],
            [false, 'data:text;base64,SGVsbG8sIFdvcmxkIQ=='],
        ];
    }
}
