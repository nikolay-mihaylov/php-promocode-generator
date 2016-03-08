<?php

namespace Rilog;

class CodeGenerator
{
    private $codes = [];     
    private $config = [ 
        'length' => 5,
        'amount' => 10,
        'characters' => '123456789-ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ]; 
        
    function __construct($config) {
        // overwrite default values
        $this->config = $config + $this->config; 
        $this->charactersLength = mb_strlen($this->config['characters'], '8bit');
    }     
    
    public function getCodes()
    {  
        $this->validate();             
             
        // check how many codes are left
        $codesLeft = $this->checkProgress();
        if ($codesLeft > 0) {
            $this->generate($codesLeft);
        }
        return array_keys($this->codes);
    }
    
    private function generate($codesLeft)
    {
        // generate codes
        for ($c = 0; $c < $codesLeft; ++$c) {
            $code = '';
            $max = $this->charactersLength - 1;
            for ($i = 0; $i < $this->config['length']; ++$i) {
                $code .= $this->config['characters'][mt_rand(0, $max)];
            }         
            $this->codes[$code] = '';
        }
        
        // check progress and generate more if needed
        $codesLeft = $this->checkProgress();
        if ($codesLeft > 0) {
            $this->generate($codesLeft);
        }
    } 
    
    private function validate()
    { 
        // Check if amount is positive
        if ($this->config['amount'] < 0) {
            throw new \Exception('Amount must be a positive number'); 
        } 
        
        // Check possible combinations count
        $possibleCombinations = pow($this->charactersLength, $this->config['length']);    
        if ($this->config['amount'] > $possibleCombinations) {
            throw new \Exception('Code amount exceeds the possible combinations count of '. $possibleCombinations); 
        } 
    }
    
    private function checkProgress()
    {
        return $this->config['amount'] - count($this->codes);
    }        
}