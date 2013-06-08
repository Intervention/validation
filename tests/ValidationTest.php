<?php

use Intervention\Validation\Validator;

class ValidationTest extends PHPUnit_Framework_Testcase
{
    public function testValidateIban()
    {
        $iban = 'DE12500105170648489890';
        $no_iban = 'DE21340155170648089890';
        $this->assertTrue(Validator::isIban($iban));
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

}
