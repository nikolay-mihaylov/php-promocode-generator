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
  // Those are the default options. If needed overwrite them when instantiating the object.
  $defaults = [
    'length' => 5, // How long should the code be?
    'amount' => 10, // How many codes to generate?
    'characters' => '123456789-ABCDEFGHIJKLMNOPQRSTUVWXYZ' // What characters should be used for the codes?
  ];
```

## Usage
You can view sample code in example folder.
```php
  require_once 'src/CodeGenerator.php'; 
        
  $obj = new Rilog\CodeGenerator([
    'length' => 6,
    'amount' => 10,
  ]);  
  $codes = $obj->getCodes(); 
  
  // prints
  Array
  (
      [0] => M7B-WM
      [1] => 8R1P4I
      [2] => 2ORNKW
      [3] => Q5EZGL
      [4] => PF7AN8
      [5] => W5XKA8
      [6] => GDHE3T
      [7] => -7CY34
      [8] => 5POXFM
      [9] => OCUCTI
  )  
```

