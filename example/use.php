<?php

    require_once '../src/CodeGenerator.php';

    // Using custom values
    $obj = new Rilog\CodeGenerator();
    $obj->setMask('XXXX-XXXX-XXXX-XXXX-XXXX-XXXX-XXXX');
    $obj->setAmount(5);
    $obj->setCharacters('0123456789');
    $codes = $obj->getCodes();

    echo '<pre>';
    print_r($codes);
    exit;

    /* Prints
        Array
        (
            [0] => 6499-0044-2728-1142-3941-4016-7557
            [1] => 3915-4036-5728-8593-0505-1111-2745
            [2] => 0341-3506-9507-2965-6818-5935-4476
            [3] => 0381-1599-9759-4471-8571-2706-4295
            [4] => 0316-7460-6279-4366-3328-0763-2156
        )
    */