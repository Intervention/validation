<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Domainname;
use PHPUnit\Framework\TestCase;

final class DomainnameTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Domainname())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'foo.com'];
        yield [true, 'foo.de'];
        yield [true, 'foo.photography'];
        yield [true, 'hüte.de'];
        yield [true, 'www.hüte.de'];
        yield [true, 'WWW.HÜTE.DE'];
        yield [true, 'googĺe.com'];
        yield [true, 'www.googĺe.com'];
        yield [true, 'fußball.example'];
        yield [true, 'ñandú.example'];
        yield [true, 'xn--4gbrim.xn----ymcbaaajlc6dj7bxne2c.xn--wgbh1c.org'];
        yield [true, 'déjà.vu.example'];
        yield [true, 'foo.bar.baz'];
        yield [true, 'foo-foo.foo-bar.baz'];
        yield [true, 'xn--dmin-moa0i.example'];
        yield [true, 'nic.vermögensberater'];
        yield [true, 'xn--fsqu00a.xn--0zwm56d'];
        yield [true, 'موقع.وزارة-الاتصالات.مصر'];
        yield [true, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar'];
        yield [true, 'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'];
        yield [true, '63-characters-is-the-longest-possible-domain-name-for-a-website.com'];
        yield [true, '0-WH-AO14-0.COM-com.net'];
        yield [true, 'foo.LU'];
        yield [true, 'g.cn'];
        yield [true, 't.co'];
        yield [true, '0.com'];
        yield [true, 'இந்தியா.com'];
        yield [false, 'foo'];
        yield [false, 'foo.f'];
        yield [false, 'foo.com.'];
        yield [false, 'foo.k12'];
        yield [false, 'foo.123'];
        yield [false, 'foo.foo_bar.bar'];
        yield [false, 'foo.bar-'];
        yield [false, '-foo.bar'];
        yield [false, 'foo-.bar'];
        yield [false, 'foo.-.bar'];
        yield [false, 'foo.-bar'];
        yield [false, 'foo.bar-'];
        yield [false, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar'];
        yield [false, 'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'];
        yield [false, ' . '];
        yield [false, '/././'];
        yield [false, '----'];
        yield [false, '?'];
        yield [false, '29383'];
        yield [false, 'x.x.x.x.x.x'];
        yield [false, '127.0.0.1'];
        yield [false, '0.0.0'];
        yield [false, 'foo.123'];
        yield [false, 'mandrill._domainkey.mailchimp.com'];
    }
}
