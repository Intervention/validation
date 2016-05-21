<?php

use Intervention\Validation\Validator;

class ValidationTest extends PHPUnit_Framework_TestCase
{
    public function testValidateIsin()
    {
        $isin = 'US0378331005';
        $no_isin = 'ZA9382189201';
        $this->assertTrue(Validator::isIsin($isin));
        $this->assertFalse(Validator::isIsin($no_isin));

        $isin = 'DE0005810055';
        $no_isin = 'DE0005810058';
        $this->assertTrue(Validator::isIsin($isin));
        $this->assertFalse(Validator::isIsin($no_isin));
    }

    public function testValidateIban()
    {
        $iban = 'DE12500105170648489890';
        $no_iban = 'DE21340155170648089890';
        $this->assertTrue(Validator::isIban($iban));
        $this->assertFalse(Validator::isIban($no_iban));

        $iban = 'GB82 WEST 1234 5698 7654 32';
        $no_iban = 'GR82 WEST 1234 5698 7654 32';
        $this->assertTrue(Validator::isIban($iban));
        $this->assertFalse(Validator::isIban($no_iban));
        
        $no_iban = '5070081';
        $this->assertFalse(Validator::isIban($no_iban));
    }

    public function testValidateBic()
    {
        $bic = 'PBNKDEFF';
        $no_bic = 'ABNFDBF';
        $this->assertTrue(Validator::isBic($bic));
        $this->assertFalse(Validator::isBic($no_bic));
    }

    public function testValidateCreditcard()
    {
        $cc = '4444111122223333';
        $no_cc = '9182819264532375';
        $this->assertTrue(Validator::isCreditcard($cc));
        $this->assertFalse(Validator::isCreditcard($no_cc));
    }

    public function testValidateHexcolor()
    {
        $hex1 = '#cccccc';
        $hex2 = 'b33517';
        $no_hex = 'x25s11';
        $this->assertTrue(Validator::isHexcolor($hex1));
        $this->assertTrue(Validator::isHexcolor($hex2));
        $this->assertFalse(Validator::isHexcolor($no_hex));
    }

    public function testValidateIsbn()
    {
        $isbn1 = '3498016709';
        $isbn2 = '978-3499255496';
        $isbn3 = '85-359-0277-5';
        $no_isbn = '123459181';
        $this->assertTrue(Validator::isIsbn($isbn1));
        $this->assertTrue(Validator::isIsbn($isbn2));
        $this->assertTrue(Validator::isIsbn($isbn3));
        $this->assertFalse(Validator::isIsbn($no_isbn));
    }

    public function testValidateIsodate()
    {
        $iso_dates = array(
            '1977-06-17',
            '2000-06-17 06:15:12',
            '1977',
            '1977-06-17 00:00',
            '1977-06-17 14:12:59',
            '2009-05-19 14:39:22+0600'
        );

        foreach ($iso_dates as $date) {
            $this->assertTrue(Validator::isIsodate($date));
        }

        $no_iso_dates = array(
            '17. Juni 1977',
            '2000-16-37 06:15:12',
            'test',
            '0000-00-00 00:00',
            '1977-06-17 44:81:99',
            '2009-05-19 14:39:22+5234'
        );

        foreach ($no_iso_dates as $no_date) {
            $this->assertFalse(Validator::isIsodate($no_date));
        }
    }

    public function testValidateUsername()
    {
        $usernames = array(
            'tester',
            'test',
            'test_',
            'mr_freeze',
            'r00t',
            'The_quick_brown_foXXX',
        );

        foreach ($usernames as $name) {
            $this->assertTrue(Validator::isUsername($name));
        }

        $no_usernames = array(
            'mr.freeze',
            'mr freeze',
            'mr-freeze',
            '1337',
            '-91819',
            '&nbsp;',
            '<html></html>',
            '-_homer_-',
            '_test_',
            '04420',
            '',
            ' ',
            'array()',
            'x',
            '$234_&',
            '?test=1',
            '€uro',
            'SupersupersupersupersupersupersupersupersupersupersuperMan',
        );

        foreach ($no_usernames as $username) {
            $this->assertFalse(Validator::isUsername($username));
        }
    }

    public function testValidateHtmlclean()
    {
        // clean
        $this->assertTrue(Validator::isHtmlclean('123456'));
        $this->assertTrue(Validator::isHtmlclean('1+2=3'));
        $this->assertTrue(Validator::isHtmlclean('The quick brown fox jumps over the lazy dog.'));
        $this->assertTrue(Validator::isHtmlclean('>>>test'));
        $this->assertTrue(Validator::isHtmlclean('>test'));
        $this->assertTrue(Validator::isHtmlclean('test>'));
        $this->assertTrue(Validator::isHtmlclean('attr="test"'));
        $this->assertTrue(Validator::isHtmlclean('one < two'));
        $this->assertTrue(Validator::isHtmlclean('two>one'));

        // html
        $this->assertFalse(Validator::isHtmlclean('The quick brown fox jumps <strong>over</strong> the lazy dog.'));
        $this->assertFalse(Validator::isHtmlclean('<html>'));
        $this->assertFalse(Validator::isHtmlclean('<HTML>test</HTML>'));
        $this->assertFalse(Validator::isHtmlclean('<html attr="test">'));
        $this->assertFalse(Validator::isHtmlclean('Test</p>'));
        $this->assertFalse(Validator::isHtmlclean('Test</>'));
        $this->assertFalse(Validator::isHtmlclean('Test<>'));
        $this->assertFalse(Validator::isHtmlclean('<0>'));
        $this->assertFalse(Validator::isHtmlclean('<>'));
        $this->assertFalse(Validator::isHtmlclean('><'));
        
        
    }

    public function testValidatePassword()
    {
        $good = array(
            'BcD3#2',
            'BcD3?2',
            'b1xo$S',
            'P0rßche',
            'Ada59926835096|70074c3d7814a506d',
            'ES6]Jascha',
            'y0mAma!',
            '2&c5DSo',
            'PW3n_9B,{)Jj[\'Z}oe[[n.W',
            '<Br0wn>'
        );

        $bad = array(
            '',
            ' ',
            '          ',
            1,
            'abc',
            'abcdef',
            'abcdef1',
            'abcdef1#',
            '1234567',
            'BcD32',
            '2&c5dso',
            'G&cadO',
            'x1cAdO',
            'x%adO',
            '<br0wn>',
            '&nbsp;',
            'bcd3_2',
            'b1Xo$',
            'b1xo$s',
            'Porsche',
            'test',
            'f&casDSo',
            'ada59926835096a70074c3d7814a506d',
            'identyowehowedeiwckeudepbetyeuw',
            'Ada59926835096|70074c3d7814a506dAda59926835096|70074c3d7814a506dX'
        );

        foreach ($good as $password) {
            $this->assertTrue(Validator::isPassword($password));
        }

        foreach ($bad as $password) {
            $this->assertFalse(Validator::isPassword($password));
        }
    }

}
