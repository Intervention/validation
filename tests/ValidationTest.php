<?php

use Intervention\Validation\Validator;

class ValidationTest extends PHPUnit_Framework_Testcase
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator;
    }

    public function testValidateIban()
    {
        $iban = 'DE12500105170648489890';
        $no_iban = 'DE21340155170648089890';
        $this->assertTrue($this->validator->isIban($iban));
        $this->assertFalse($this->validator->isIban($no_iban));
    }

    public function testValidateBic()
    {
        $bic = 'PBNKDEFF';
        $no_bic = 'ABNFDBF';
        $this->assertTrue($this->validator->isBic($bic));
        $this->assertFalse($this->validator->isBic($no_bic));
    }

    public function testValidateCreditcard()
    {
        $cc = '4444111122223333';
        $no_cc = '9182819264532375';
        $this->assertTrue($this->validator->isCreditcard($cc));
        $this->assertFalse($this->validator->isCreditcard($no_cc));
    }

    public function testValidateHexcolor()
    {
        $hex1 = '#cccccc';
        $hex2 = 'b33517';
        $no_hex = 'x25s11';
        $this->assertTrue($this->validator->isHexcolor($hex1));
        $this->assertTrue($this->validator->isHexcolor($hex2));
        $this->assertFalse($this->validator->isHexcolor($no_hex));
    }

    public function testValidateIsbn()
    {
        $isbn1 = '3498016709';
        $isbn2 = '978-3499255496';
        $isbn3 = '85-359-0277-5';
        $no_isbn = '123459181';
        $this->assertTrue($this->validator->isIsbn($isbn1));
        $this->assertTrue($this->validator->isIsbn($isbn2));
        $this->assertTrue($this->validator->isIsbn($isbn3));
        $this->assertFalse($this->validator->isIsbn($no_isbn));
    }

}