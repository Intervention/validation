<?php

namespace Intervention\Validation\Test\Rules;

class Base64Test extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'Zm9v',
        'YmFy',
        'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4=',
        'bGFuZ3VhZ2U6IHBocAoKZGlzdDogJ3RydXN0eScKCnBocDoKICAtICc3LjInCiAgLSAnNy4zJwoKY2FjaGU6CiAgZGlyZWN0b3JpZXM6CiAgICAtIC4vdmVuZG9yCgppbnN0YWxsOgogIC0gY29tcG9zZXIgaW5zdGFsbAoKc2NyaXB0OiB2ZW5kb3IvYmluL3BocHVuaXQK',
        'iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAQAAAD8x0bcAAAAT0lEQVR4AbXRQQrAMAgF0d7J+5/NggjTT5lNIOPSt4l5PvVOlmBTyHLxnwFqZmAwUMNARmBHqIIoKkHK/HWQQHpMO2gsleUHw6w7DOQNeQHgxcBzQQpFawAAAABJRU5ErkJggg==',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        'foo',
        'bar',
        'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy=',
        'bGFuZ3VhZ2U6IHBocAoKZGlzdDogJ3RydXN0eScKCnBocDoKICAtICc3xx',
        'iVBORw0KGgoAAAANSUhEUgAAABIAAAAsCcAQAAAD8x0bcAAAaT0lEQVR4AbXRQQrAMAgF0d7J+5/NggjTT5lNIOPSt4l5PvVOlmBTyHLxnwFqZmAwUMNARmBHqIIoKkHK/HWQQHpMO2gsleUHw6w7DOQNeQHgxcBzQQpFawAAAABJRU5ErkJggg==',
    ];
}
