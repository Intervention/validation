<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\MimeType;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class MimeTypeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new MimeType()]);
        $this->assertEquals($result, $validator->validate($value));
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
