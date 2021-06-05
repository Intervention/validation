<?php

namespace Intervention\Validation\Test\Rules;

class MimeTypeTest extends AbstractRuleTestCase
{
    /**
     * Rule symbol
     */
    public $symbol = 'mimetype';

    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'application/pdf',
        'application/zip',
        'image/jpeg',
        'image/svg+xml',
        'multipart/form-data',
        'application/octet-stream',
        'font/woff',
        'model/vrml',
        'video/mp4',
        'audio/mpeg',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        'foo/bar',
        'foo/jpeg',
        '/foo',
        'image',
        'foo',
    ];
}
