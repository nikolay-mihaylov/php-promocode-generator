<?php

namespace Rilog;

use Exception;

class CodeGenerator
{
    /**
     * Codes collection.
     *
     * @var array
     */       
    private $_codes = [];    
    
    /**
     * Length of each code.
     *
     * @var integer
     */    
    private $_length;
    
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
     * Set code length.
     *
     * @param integer $number.
     * @return void.
     */    
    public function setLength($number)
    {
        if ((int) $number <= 0) {
            throw new Exception('Length must be integer greater than 0'); 
        }
        $this->_length = (int) $number;
    }    
    
    /**
     * Get code length.
     *
     * @return integer.
     */      
    public function getLength()
    { 
        return (empty($this->_length)) ? 5 : $this->_length;
    }  

    /**
     * Set amount of codes to be generated.
     *
     * @param integer $number.
     * @return void.
     */    
    public function setAmount($number)
    {
        if ((int) $number <= 0) {
            throw new Exception('Amount must be integer greater than 0'); 
        }        
        $this->_amount = (int) $number;
    }        
    
    /**
     * Get code amount.
     *
     * @return integer.
     */      
    public function getAmount()
    { 
        return (empty($this->_amount)) ? 10 : $this->_amount;        
    }
    
    /**
     * Set characters to be used for generation.
     *
     * @param string $characters.
     * @return void.
     */    
    public function setCharacters($characters)
    {
        $this->_characters = $characters;
    }        
    
    /**
     * Get characters.
     *
     * @return string.
     */      
    public function getCharacters()
    { 
        return (empty($this->_characters)) ? '123456789-ABCDEFGHIJKLMNOPQRSTUVWXYZ' : $this->_characters;   
    }
    
	/**
	 * Get available characters count.
	 *
	 * @return integer.
	 */      
    public function getCharactersCount()
    {  
        return mb_strlen($this->getCharacters(), '8bit');   
    }
    
    /**
     * Returns the generated codes
     *
     * @return array.
     */         
    public function getCodes()
    {  
        // Check possible combinations count
        $possibleCombinations = pow($this->getCharactersCount(), $this->getLength());    
        if ($this->getAmount() > $possibleCombinations) {
            throw new \Exception('Code amount exceeds the possible combinations count of '. $possibleCombinations); 
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
     * @return void.
     */             
    private function generate($codesLeft)
    {
        // generate codes
        $characters = $this->getCharacters();
        $max = $this->getCharactersCount() - 1;
        $codeLength = $this->getLength();
        for ($c = 0; $c < $codesLeft; ++$c) {
            $code = '';
            for ($i = 0; $i < $codeLength; ++$i) {
                $code .= $characters[mt_rand(0, $max)];
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
     * @return integer.
     */          
    private function checkProgress()
    {
        return $this->getAmount() - count($this->_codes);
    }        
}