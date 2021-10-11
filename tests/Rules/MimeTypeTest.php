<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\MimeType;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class MimeTypeTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new MimeType()]]);
        $this->assertEquals($result, $validator->passes());
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
