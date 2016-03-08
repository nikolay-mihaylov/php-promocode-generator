<?php

    require_once '../src/CodeGenerator.php';
      
    $obj = new Rilog\CodeGenerator([
        'length' => 6,
        'amount' => 10,
    ]);  
    $codes = $obj->getCodes(); 
    
    echo '<pre>';
    print_r($codes);
    exit;