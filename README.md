# php-promocode-generator
Generates custom promo codes. Amount, mask and characters are configurable.

## But why?
Past few months I had to generate tons of codes for promo games. Every time I wrote custom code, so I decided not to reinvent the wheel and create a little library. Hope I can save someone some time :)

## Installation
- [Download the archive](https://github.com/nikolay-mihaylov/php-promocode-generator/archive/master.zip)
- Composer - **coming soon**

## Options
```php
  $obj = new Rilog\CodeGenerator();
  
  // Set mask (code template). Default: 'XXXXX'
  $obj->setMask('XXX-XXX-XXX-XXX-XXX-XXX-XXX');
  
  // Set amount of codes to be generated. Default: 10 codes
  $obj->setAmount(110);  
  
  // Set allowed characters to be used for generation. Default: 0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ
  $obj->setCharacters(123456789); 
  
  // Get the codes
  $codes = $obj->getCodes(); 
```

## Usage
You can view sample code in example folder.
```php
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
```

