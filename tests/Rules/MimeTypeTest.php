<?php

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\MimeType;
use PHPUnit\Framework\TestCase;

class MimeTypeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new MimeType())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, 'application/pdf'],
            [true, 'application/zip'],
            [true, 'image/jpeg'],
            [true, 'image/svg+xml'],
            [true, 'multipart/form-data'],
            [true, 'application/octet-stream'],
            [true, 'font/woff'],
            [true, 'model/vrml'],
            [true, 'video/mp4'],
            [true, 'audio/mpeg'],
            [true, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            [false, 'foo/bar'],
            [false, 'foo/jpeg'],
            [false, '/foo'],
            [false, 'image'],
            [false, 'foo'],
        ];
    }
}
