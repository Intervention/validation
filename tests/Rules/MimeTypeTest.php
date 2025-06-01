<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\MimeType;
use PHPUnit\Framework\TestCase;

final class MimeTypeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new MimeType())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'application/pdf'];
        yield [true, 'application/zip'];
        yield [true, 'image/jpeg'];
        yield [true, 'image/svg+xml'];
        yield [true, 'multipart/form-data'];
        yield [true, 'application/octet-stream'];
        yield [true, 'font/woff'];
        yield [true, 'model/vrml'];
        yield [true, 'video/mp4'];
        yield [true, 'audio/mpeg'];
        yield [true, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        yield [false, 'foo/bar'];
        yield [false, 'foo/jpeg'];
        yield [false, '/foo'];
        yield [false, 'image'];
        yield [false, 'foo'];
    }
}
