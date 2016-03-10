# php-promocode-generator
Generates custom length promo codes. Amount, length and characters are configurable.

## But why?
Past few months I had to generate tons of codes for promo games. Every time I wrote custom code, so I decided not to reinvent the wheel and create a little library. Hope I can save someone some time :)

## Requirements
- PHP 5.4 or higher

## Installation
- [Download the archive](https://github.com/nikolay-mihaylov/php-promocode-generator/archive/master.zip)
- Composer - **coming soon**

## Options
```php
  $obj = new Rilog\CodeGenerator();
  
  // Set code Length. Default: 5 characters
  $obj->setLength(10);
  
  // Set amount of codes to be generated. Default: 10 codes
  $obj->setAmount(10);  
  
  // Set allowed characters to be used for generation. Default: 123456789-ABCDEFGHIJKLMNOPQRSTUVWXYZ
  $obj->setCharacters(123456789); 
```

## Usage
You can view sample code in example folder.
```php
    require_once '../src/CodeGenerator.php';
      
    // Using with default values  
    $obj = new Rilog\CodeGenerator();       
    $codes = $obj->getCodes(); 
    
    echo '<pre>';
    print_r($codes);
    exit;
     
    /* Prints
        Array
        (
            [0] => 5P6XF
            [1] => FBGOW
            [2] => K2REN
            [3] => MS9GO
            [4] => DDYJK
            [5] => YVSWR
            [6] => CKY46
            [7] => ZF7D4
            [8] => B2YJ5
            [9] => 2TS8O
        )
    */
        
    // Setting custom values 
    $obj = new Rilog\CodeGenerator();
    $obj->setLength(8);    
    $obj->setAmount(10);    
    $obj->setCharacters('abcdef123456');    
    $codes = $obj->getCodes(); 
    
    echo '<pre>';
    print_r($codes);
    exit;    
    
    /* Prints
        Array
        (
            [0] => a36fba5b
            [1] => 1ebeaf2a
            [2] => 1dc144b1
            [3] => d663ae65
            [4] => be45a2d3
            [5] => ad6542c1
            [6] => dfa36d4d
            [7] => c6c1f32e
            [8] => 3ca5db2b
            [9] => df3d3166
        )    
    */
```

