<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Username;
use PHPUnit\Framework\TestCase;

final class UsernameTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Username())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'tom'];
        yield [true, 'tester'];
        yield [true, 'test12'];
        yield [true, 't-e-s-t'];
        yield [true, 'mr_freeze'];
        yield [true, 'mr-freeze'];
        yield [true, 'r00t'];
        yield [true, 'theQuickBrownFoxJump'];
        yield [true, 'mr'];
        yield [true, 'x'];
        yield [true, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'];
        yield [true, 'theQuickBrownFoxJumps'];
        yield [false, 'homer-'];
        yield [false, '-homer'];
        yield [false, 'homer_'];
        yield [false, '_homer'];
        yield [false, '_homer_'];
        yield [false, '1homer'];
        yield [false, ' homer'];
        yield [false, 'o__o'];
        yield [false, 'mr.freeze'];
        yield [false, 'mr freeze'];
        yield [false, '-mr-freeze'];
        yield [false, '1337'];
        yield [false, '-91819'];
        yield [false, '&nbsp;'];
        yield [false, '<html></html>'];
        yield [false, '-_homer_-'];
        yield [false, '1mo'];
        yield [false, '_test_'];
        yield [false, '04420'];
        yield [false, 'array()'];
        yield [false, '$234_&'];
        yield [false, '?test=1'];
        yield [false, '€uro'];
        yield [false, 'ⓣⓔⓢⓣ'];
        yield [false, '𝒕𝒆𝒔𝒕'];
    }
}
