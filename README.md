# str_putcsv

The missing `str_putcsv` function for php.

Works analogous to [`str_getcsv`](https://www.php.net/manual/function.str-getcsv.php).

## Installation

    composer require mll-lab/str_putcsv

## Usage

```php
<?php declare(strict_types=1);

require 'vendor/autoload.php';

$entries = [
    [1, 'a'],
    [2, 'b'],
];

$csv = '';
foreach ($entries as $entry) {
    $csv .= str_putcsv($entry) . PHP_EOL;
}
var_dump($csv);
```

Result:

```
string(8) "1,a
2,b
"
```

## Credits

Based on https://github.com/kafene/str_putcsv
