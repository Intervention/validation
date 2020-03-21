<?php

namespace Intervention\Validation\Test\Rules;

class DomainnameTest extends AbstractRuleTestCase
{
    /**
     * Valid values
     *
     * @var array
     */
    protected $valid = [
        'foo.com',
        'foo.de',
        'foo.photography',
        'hüte.de',
        'www.hüte.de',
        'WWW.HÜTE.DE',
        'googĺe.com',
        'www.googĺe.com',
        'fußball.example',
        'ñandú.example',
        'xn--4gbrim.xn----ymcbaaajlc6dj7bxne2c.xn--wgbh1c.org',
        'déjà.vu.example',
        'foo.bar.baz',
        'foo-foo.foo-bar.baz',
        'xn--dmin-moa0i.example',
        'nic.vermögensberater',
        'xn--fsqu00a.xn--0zwm56d',
        'موقع.وزارة-الاتصالات.مصر',
        'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar',
        'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        '63-characters-is-the-longest-possible-domain-name-for-a-website.com',
        '0-WH-AO14-0.COM-com.net',
        'foo.LU',
        'g.cn',
        't.co',
        '0.com',
    ];

    /**
     * Invalid values
     *
     * @var array
     */
    protected $invalid = [
        '',
        ' ',
        'foo',
        'foo.f',
        'foo.com.',
        'foo.k12',
        'foo.123',
        'foo.foo_bar.bar',
        'foo.bar-',
        '-foo.bar',
        'foo-.bar',
        'foo.-.bar',
        'foo.-bar',
        'foo.bar-',
        'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.bar',
        'bar.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        ' . ',
        '/././',
        '----',
        '?',
        "\n",
        '29383',
        'x.x.x.x.x.x',
        '127.0.0.1',
        '0.0.0',
        'foo.123',
        'mandrill._domainkey.mailchimp.com',
    ];
}
