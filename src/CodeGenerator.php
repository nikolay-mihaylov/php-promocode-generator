<?php

namespace Rilog;

use InvalidArgumentException;

class CodeGenerator
{
    /**
     * Codes collection.
     *
     * @var array
     */
    private $_codes = array();

    /**
     * Amount of generated codes.
     *
     * @var integer
     */
    private $_amount;

    /**
     * Characters used for code generation.
     *
     * @var string
     */
    private $_characters;

    /**
     * Mask template.
     *
     * Example: XXXX-XXXX-XXXX
     *          XX~~XX_XXXX
     * Default: XXXXX
     *
     * @var string Code placeholders must be defined with X.
     */
    private $_mask;

    /**
     * Set mask.
     *
     * @param string $mask
     * @return void
     */
    public function setMask($mask)
    {
        if (substr_count($mask, 'X') < 1) {
            throw new InvalidArgumentException('Mask should contain at least one X symbol.');
        }
        $this->_mask = $mask;
    }

    /**
     * Get code length.
     *
     * @return integer
     */
    public function getMask()
    {
        return (empty($this->_mask)) ? 'XXXXX' : $this->_mask;
    }

    /**
     * Set amount of codes to be generated.
     *
     * @param integer $number
     * @return void
     */
    public function setAmount($number)
    {
        if ((int) $number <= 0) {
            throw new InvalidArgumentException('Amount must be integer greater than 0');
        }
        $this->_amount = (int) $number;
    }

    /**
     * Get code amount.
     *
     * @return integer
     */
    public function getAmount()
    {
        return (empty($this->_amount)) ? 10 : $this->_amount;
    }

    /**
     * Set characters to be used for generation.
     *
     * @param string $characters
     * @return void
     */
    public function setCharacters($characters)
    {
        $this->_characters = $characters;
    }

    /**
     * Get characters.
     *
     * @return string
     */
    public function getCharacters()
    {
        return (empty($this->_characters)) ? '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ' : $this->_characters;
    }

    /**
     * Get available characters count.
     *
     * @return integer
     */
    public function getCharactersCount()
    {
        return mb_strlen($this->getCharacters(), '8bit');
    }

    /**
     * Get mask length without hiphens.
     *
     * @return integer
     */
    public function getLength()
    {
        return substr_count($this->getMask(), 'X');
    }

    /**
     * Returns the generated codes
     *
     * @return array
     */
    public function getCodes()
    {
        // Check possible combinations count
        $possibleCombinations = pow($this->getCharactersCount(), $this->getLength());
        if ($this->getAmount() > $possibleCombinations) {
            throw new InvalidArgumentException('Code amount exceeds the possible combinations count of '. $possibleCombinations);
        }

        // check how many codes are left
        $codesLeft = $this->checkProgress();
        if ($codesLeft > 0) {
            $this->generate($codesLeft);
        }
        return array_keys($this->_codes);
    }

    /**
     * Generate codes.
     *
     * @param integer $codesLeft
     * @return void
     */
    private function generate($codesLeft)
    {
        $characters = $this->getCharacters();
        $max = $this->getCharactersCount() - 1;
        $codeLength = $this->getLength();
        $mask = $this->getMask();
        for ($c = 0; $c < $codesLeft; ++$c) {
            $code = $mask;
            for ($i = 0; $i < $codeLength; ++$i) {
                $pos = strpos($code, 'X');
                if ($pos !== false) {
                    $code = substr_replace($code, $characters[mt_rand(0, $max)], $pos, 1);
                }
            }
            $this->_codes[$code] = '';
        }

        // check progress and generate more if needed
        $codesLeft = $this->checkProgress();
        if ($codesLeft > 0) {
            $this->generate($codesLeft);
        }
    }

    /**
     * Check how many codes are left to be generated.
     *
     * @return integer
     */
    private function checkProgress()
    {
        return $this->getAmount() - count($this->_codes);
    }
}