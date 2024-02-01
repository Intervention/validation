<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Base64;
use PHPUnit\Framework\TestCase;

class Base64Test extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testValidation($result, $value)
    {
        $valid = (new Base64())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [
                true,
                'Zm9v'
            ],
            [
                true,
                'YmFy'
            ],
            [
                true,
                'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4='
            ],
            [
                true,
                'bGFuZ3VhZ2U6IHBocAoKZGlzdDogJ3RydXN0eScKCnBocDoKICAtICc3LjInCiAgLSAnNy4zJw' .
                'oKY2FjaGU6CiAgZGlyZWN0b3JpZXM6CiAgICAtIC4vdmVuZG9yCgppbnN0YWxsOgogIC0gY29tcG9zZX' .
                'IgaW5zdGFsbAoKc2NyaXB0OiB2ZW5kb3IvYmluL3BocHVuaXQK'
            ],
            [
                true,
                'iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAQAAAD8x0bcAAAAT0lEQVR4AbXRQQrAMAgF0d7' .
                'J+5/NggjTT5lNIOPSt4l5PvVOlmBTyHLxnwFqZmAwUMNARmBHqIIoKkHK/HWQQHpMO2gsleUH' .
                'w6w7DOQNeQHgxcBzQQpFawAAAABJRU5ErkJggg=='
            ],
            [
                false,
                'foo'
            ],
            [
                false,
                'bar'
            ],
            [
                false,
                'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
            ],
            [
                false,
                'bGFuZ3VhZ2U6IHBocAoKZGlzdDogJ3RydXN0eScKCnBocDoKICAtICc3xx'
            ],
            [
                false,
                'iVBORw0KGgoAAAANSUhEUgAAABIAAAAsCcAQAAAD8x0bcAAAaT0lEQVR4AbXRQQrAMAgF0d7J+5/NggjTT5lNIOPSt4' .
                'l5PvVOlmBTyHLxnwFqZmAwUMNARmBHqIIoKkHK/HWQQHpMO2gsleUHw6w7DOQNeQHgxcBzQQpFawAAAABJRU5ErkJggg=='
            ],
        ];
    }
}
