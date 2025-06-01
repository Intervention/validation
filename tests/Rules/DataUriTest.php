<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\DataUri;
use PHPUnit\Framework\TestCase;

final class DataUriTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new DataUri())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderImages')]
    public function testValidationWithMimeTypes(bool $result, string $value): void
    {
        $valid = (new DataUri(['image/jpeg', 'image/png']))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [
            true,
            'data:,'
        ];
        yield [
            true,
            'data:,foo'
        ];
        yield [
            true,
            'data:;base64,Zm9v'
        ];
        yield [
            true,
            'data:,foo%20bar'
        ];
        yield [
            true,
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAH' .
                'ElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg=='
        ];
        yield [
            true,
            'data:text/vnd-example+xyz;foo=bar;base64,R0lGODdh'
        ];
        yield [
            true,
            'data:text/vnd-example+xyz;foo=bar;bar-baz=false;base64,R0lGODdh'
        ];
        yield [
            true,
            'data:text/plain;charset=UTF-8;page=21,the%20data:1234,5678'
        ];
        yield [
            true,
            'data:text/plain;charset=US-ASCII,foobar'
        ];
        yield [
            true,
            'data:text/plain,foobar'
        ];
        yield [
            true,
            'data:,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            true,
            'data:,Hello%2C%20World%21'
        ];
        yield [
            true,
            'data:text/plain;base64,SGVsbG8sIFdvcmxkIQ=='
        ];
        yield [
            true,
            'data:text/html,<script>alert(\'hi\');</script>'
        ];
        yield [
            false,
            'foo'
        ];
        yield [
            false,
            'bar'
        ];
        yield [
            false,
            'data:'
        ];
        yield [
            false,
            'data:;base64,foo'
        ];
        yield [
            false,
            'data:foo/plain,foobar'
        ];
        yield [
            false,
            'data:;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            false,
            'data:image/jpeg;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            false,
            'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4='
        ];
        yield [
            false,
            'data:text;base64,SGVsbG8sIFdvcmxkIQ=='
        ];
    }

    public static function dataProviderImages(): Generator
    {
        yield [
            false,
            'data:,'
        ];
        yield [
            false,
            'data:,foo'
        ];
        yield [
            false,
            'data:;base64,Zm9v'
        ];
        yield [
            false,
            'data:,foo%20bar'
        ];
        yield [
            true,
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAH' .
                'ElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg=='
        ];
        yield [
            false,
            'data:text/vnd-example+xyz;foo=bar;base64,R0lGODdh'
        ];
        yield [
            false,
            'data:text/vnd-example+xyz;foo=bar;bar-baz=false;base64,R0lGODdh'
        ];
        yield [
            false,
            'data:text/plain;charset=UTF-8;page=21,the%20data:1234,5678'
        ];
        yield [
            false,
            'data:text/plain;charset=US-ASCII,foobar'
        ];
        yield [
            false,
            'data:text/plain,foobar'
        ];
        yield [
            false,
            'data:,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            false,
            'data:,Hello%2C%20World%21'
        ];
        yield [
            false,
            'data:text/plain;base64,SGVsbG8sIFdvcmxkIQ=='
        ];
        yield [
            false,
            'data:text/html,<script>alert(\'hi\');</script>'
        ];
        yield [
            false,
            'foo'
        ];
        yield [
            false,
            'bar'
        ];
        yield [
            false,
            'data:'
        ];
        yield [
            false,
            'data:;base64,foo'
        ];
        yield [
            false,
            'data:foo/plain,foobar'
        ];
        yield [
            false,
            'data:;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            false,
            'data:image/jpeg;base64,VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy='
        ];
        yield [
            false,
            'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZy4='
        ];
        yield [
            false,
            'data:text;base64,SGVsbG8sIFdvcmxkIQ=='
        ];
    }
}
