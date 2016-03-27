<?php

namespace Rilog\Tests;

require_once __DIR__ . '/../src/CodeGenerator.php';

use Rilog\CodeGenerator;

class CodeGeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $_mask = 'XXX-XXX-XX';
    private $_invalidMask = '111';
    private $_amountDefault = 10;
    private $_amount = 555;
    private $_defaultCharacters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
    private $_characters = '123';

    public function __construct()
    {
        $this->_codeGenerator = new CodeGenerator();
    }

    public function testSetMask()
    {
        $this->_codeGenerator->setMask($this->_mask);
        $this->assertEquals($this->_mask, $this->_codeGenerator->getMask());
    }

    public function testSetMaskInvalidException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_codeGenerator->setMask($this->_invalidMask);
    }

    public function testGetMaskDefault()
    {
        $this->assertEquals('XXXXX', $this->_codeGenerator->getMask());
    }

    public function testGetMaskCustom()
    {
        $this->_codeGenerator->setMask($this->_mask);
        $this->assertEquals($this->_mask, $this->_codeGenerator->getMask());
    }

    public function testSetAmountStringException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_codeGenerator->setAmount('asd');
    }

    public function testSetAmountNegativeIntegerException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_codeGenerator->setAmount(-11);
    }

    public function testGetAmountDefault()
    {
        $this->assertEquals($this->_amountDefault, $this->_codeGenerator->getAmount());
    }

    public function testGetAmountCustom()
    {
        $this->_codeGenerator->setAmount($this->_amount);
        $this->assertEquals($this->_amount, $this->_codeGenerator->getAmount());
    }

    public function testSetCharacters()
    {
        $this->_codeGenerator->setCharacters($this->_characters);
        $this->assertEquals($this->_characters, $this->_codeGenerator->getCharacters());
    }

    public function testGetCharactersDefault()
    {
        $this->assertEquals($this->_defaultCharacters, $this->_codeGenerator->getCharacters());
    }

    public function testGetCharactersCustom()
    {
        $this->_codeGenerator->setCharacters($this->_characters);
        $this->assertEquals($this->_characters, $this->_codeGenerator->getCharacters());
    }

    public function testGetCharactersCountDefault()
    {
        $this->assertEquals(mb_strlen($this->_defaultCharacters, '8bit'), $this->_codeGenerator->getCharactersCount());
    }

    public function testGetCharactersCountCustom()
    {
        $this->_codeGenerator->setCharacters($this->_characters);
        $this->assertEquals(mb_strlen($this->_characters, '8bit'), $this->_codeGenerator->getCharactersCount());
    }

    public function testGetLengthDefault()
    {
        $this->assertEquals(substr_count($this->_codeGenerator->getMask(), 'X'), $this->_codeGenerator->getLength());
    }

    public function testGetLengtCustom()
    {
        $this->_codeGenerator->setMask($this->_mask);
        $this->assertEquals(substr_count($this->_codeGenerator->getMask(), 'X'), $this->_codeGenerator->getLength());
    }

    public function testGetCodesDefaultAmount()
    {
        $this->assertEquals($this->_amountDefault, count($this->_codeGenerator->getCodes()));
    }

    public function testGetCodesCustomAmount()
    {
        $this->_codeGenerator->setAmount($this->_amount);
        $this->assertEquals($this->_amount, count($this->_codeGenerator->getCodes()));
    }

    public function testGetCodesAmountException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->_codeGenerator->setCharacters(123);
        $this->_codeGenerator->setAmount($this->_amount);
        $this->assertEquals($this->_amount, count($this->_codeGenerator->getCodes()));
    }
}