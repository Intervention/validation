<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Domainname;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class DomainnameTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Domainname()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, 'foo.com'],
            [true, 'foo.de'],
            [true, 'foo.photography'],
            [true, 'hüte.de'],
            [true, 'www.hüte.de'],
            [true, 'WWW.HÜTE.DE'],
            [true, 'googĺe.com'],
            [true, 'www.googĺe.com'],
            [true, 'fußball.example'],
            [true, 'ñandú.example'],
            [true, 'xn--4gbrim.xn----ymcbaaajlc6dj7bxne2c.xn--wgbh1c.org'],
            [true, 'déjà.vu.example'],
            [true, 'foo.bar.baz'],
            [true, 'foo-foo.foo-bar.baz'],
            [true, 'xn--dmin-moa0i.example'],
            [true, 'nic.vermögensberater'],
            [true, 'xn--fsqu00a.xn--0zwm56d'],
            [true, 'موقع.وزارة-الاتصالات.مصر'],
            [true, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar'],
            [true, 'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'],
            [true, '63-characters-is-the-longest-possible-domain-name-for-a-website.com'],
            [true, '0-WH-AO14-0.COM-com.net'],
            [true, 'foo.LU'],
            [true, 'g.cn'],
            [true, 't.co'],
            [true, '0.com'],
            [false, 'foo'],
            [false, 'foo.f'],
            [false, 'foo.com.'],
            [false, 'foo.k12'],
            [false, 'foo.123'],
            [false, 'foo.foo_bar.bar'],
            [false, 'foo.bar-'],
            [false, '-foo.bar'],
            [false, 'foo-.bar'],
            [false, 'foo.-.bar'],
            [false, 'foo.-bar'],
            [false, 'foo.bar-'],
            [false, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar'],
            [false, 'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'],
            [false, ' . '],
            [false, '/././'],
            [false, '----'],
            [false, '?'],
            [false, '29383'],
            [false, 'x.x.x.x.x.x'],
            [false, '127.0.0.1'],
            [false, '0.0.0'],
            [false, 'foo.123'],
            [false, 'mandrill._domainkey.mailchimp.com'],
        ];
    }
}
